
CREATE TABLE usuarios (
    idUsuario INT(1) PRIMARY KEY AUTO_INCREMENT,
    NombreUsuario VARCHAR(40) NOT NULL,
    Correo VARCHAR(40) UNIQUE NOT NULL,
    Password VARCHAR(30)  NOT NULL,
    Tipo CHAR(1) NOT NULL DEFAULT 'U',
    Bloqueado INT(1) NOT NULL DEFAULT 0,
    Intentos INT(1) NOT NULL DEFAULT 0
  );
  
  
INSERT INTO usuarios (NombreUsuario, Correo, Password, Tipo) VALUES
('Daniel', 'dleon29@alumnos.uaq.mx', 'D123', 'A'),
('Andres', 'ajimenez69@alumnos.uaq.mx','A123', 'A'),
('Michell', 'ale.gv258@gmail.com', 'M123', 'A');