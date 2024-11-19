USE DB202DWESProyectoTema4;

INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil) VALUES
('admin', SHA2('adminpaso', 256), 'administrador', 'administrador'),
('victor', SHA2('victorpaso', 256), 'Víctor García Gordón', 'usuario'),
('alex', SHA2('alexpaso', 256), 'Alex Asensio Sánchez', 'usuario'),
('luis', SHA2('luispaso', 256), 'Luis Ferreras González', 'usuario'),
('jesus', SHA2('jesuspaso', 256), 'Jesus Ferreras González', 'usuario'),
('heraclio', SHA2('heracliopaso', 256), 'Heraclio Borbujo Moran', 'usuario'),
('amor', SHA2('amorpaso', 256), 'Amor Rodriguez Navarro', 'usuario');

INSERT INTO T02_Departamento VALUES
('ABC', 'Departamento Informática', now(), 3432, now()),
('DEF', 'Departamento Matemáticas', now(), 4324, '2024-11-03 16:00:00'),
('GHI', 'Departamento Lengua', now(), 654, now()),
('JKL', 'Departamento Historia', now(), 654.6, '2024-11-05 14:00:00'),
('MNO', 'Departamento Religión', now(), 8766, '2024-11-02 13:00:00');

