CREATE DATABASE IF NOT EXISTS inversiones;
USE inversiones;

CREATE TABLE IF NOT EXISTS CUENTAHABIENTE (
    id_cuentahabiente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    telefono VARCHAR(15)
);

CREATE TABLE IF NOT EXISTS INVERSION (
    id_inversion INT AUTO_INCREMENT PRIMARY KEY,
    id_cuentahabiente INT,
    monto FLOAT NOT NULL CHECK (monto >= 5000),
    plazo INT NOT NULL CHECK (plazo BETWEEN 1 AND 365),
    interes_ganado FLOAT,
    FOREIGN KEY (id_cuentahabiente) REFERENCES CUENTAHABIENTE(id_cuentahabiente)
);
