from fastapi import FastAPI, HTTPException, Depends
from pydantic import BaseModel
from typing import List, Optional
from sqlalchemy import create_engine, Column, Integer, String
from sqlalchemy.ext.declarative import declarative_base
from sqlalchemy.orm import sessionmaker, Session
from fastapi.middleware.cors import CORSMiddleware

#Configuración de Base de Datos
SQLALCHEMY_DATABASE_URL = "mysql+pymysql://root:bd2025+@localhost:3306/biblioteca_nubra"

engine = create_engine(SQLALCHEMY_DATABASE_URL)
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)
Base = declarative_base()

#Modelo de Base de Datos 
class LibroFisicoDB(Base):
    __tablename__ = "libros_fisicos"

    id = Column(Integer, primary_key=True, index=True)
    titulo = Column(String(255))
    autor = Column(String(255))
    año = Column(Integer)
    clasificacion = Column(String(50))
    ubicacion = Column(String(100))

#Esquema Pydantic (Para validar datos que entran y salen)
class LibroFisicoBase(BaseModel):
    titulo: str
    autor: str
    año: int
    clasificacion: str
    ubicacion: str

class LibroFisico(LibroFisicoBase):
    id: int
    class Config:
        from_attributes = True

#Inicializar App
app = FastAPI()

# Configurar CORS (Para que Laravel/JS pueda llamar a esta API)
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Dependencia para obtener sesión de BD
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# --- RUTAS (ENDPOINTS) ---

# Obtener todos los libros
@app.get("/libros", response_model=List[LibroFisico])
def read_libros(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    libros = db.query(LibroFisicoDB).offset(skip).limit(limit).all()
    return libros

# Crear un libro
@app.post("/libros", response_model=LibroFisico)
def create_libro(libro: LibroFisicoBase, db: Session = Depends(get_db)):
    db_libro = LibroFisicoDB(**libro.dict())
    db.add(db_libro)
    db.commit()
    db.refresh(db_libro)
    return db_libro

# Obtener un libro por ID
@app.get("/libros/{libro_id}", response_model=LibroFisico)
def read_libro(libro_id: int, db: Session = Depends(get_db)):
    libro = db.query(LibroFisicoDB).filter(LibroFisicoDB.id == libro_id).first()
    if libro is None:
        raise HTTPException(status_code=404, detail="Libro no encontrado")
    return libro

# Eliminar un libro
@app.delete("/libros/{libro_id}")
def delete_libro(libro_id: int, db: Session = Depends(get_db)):
    libro = db.query(LibroFisicoDB).filter(LibroFisicoDB.id == libro_id).first()
    if libro is None:
        raise HTTPException(status_code=404, detail="Libro no encontrado")
    
    db.delete(libro)
    db.commit()
    return {"message": "Libro eliminado correctamente"}

# Actualizar un libro existente
@app.put("/libros/{libro_id}", response_model=LibroFisico)
def update_libro(libro_id: int, libro: LibroFisicoBase, db: Session = Depends(get_db)):
    db_libro = db.query(LibroFisicoDB).filter(LibroFisicoDB.id == libro_id).first()
    if db_libro is None:
        raise HTTPException(status_code=404, detail="Libro no encontrado")
    
    # Actualizar campos
    for key, value in libro.dict().items():
        setattr(db_libro, key, value)

    db.commit()
    db.refresh(db_libro)
    return db_libro