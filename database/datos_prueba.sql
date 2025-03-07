USE almidonadas;

-- Insertar usuarios de prueba
INSERT INTO Usuarios (nombre, email, password, role) VALUES
('Admin', 'admin@almidonadas.com', 'password123', 'admin'),
('Cliente 1', 'cliente1@example.com', 'password123', 'cliente'),
('Cliente 2', 'cliente2@example.com', 'password123', 'cliente');

-- Insertar productos de prueba
INSERT INTO Productos (nombre, descripcion, precio, categoria, imagen) VALUES
('Torta de Chocolate', 'Deliciosa torta de chocolate con crema.', 25.99, 'tortas', 'torta_chocolate.jpg'),
('Galletas de Vainilla', 'Galletas crujientes con sabor a vainilla.', 5.99, 'galletas', 'galletas_vainilla.jpg'),
('Quesillo Tradicional', 'Quesillo casero con caramelo.', 12.99, 'quesillos', 'quesillo_tradicional.jpg');

-- Insertar pedidos de prueba
INSERT INTO Pedidos (usuario_id, estado, total) VALUES
(2, 'pendiente', 25.99),
(3, 'entregado', 18.98);

-- Insertar detalles de pedidos de prueba
INSERT INTO DetallesPedido (pedido_id, producto_id, cantidad, precio_unitario) VALUES
(1, 1, 1, 25.99),
(2, 2, 2, 5.99),
(2, 3, 1, 12.99);

-- Insertar reseñas de prueba
INSERT INTO Reseñas (usuario_id, producto_id, comentario, puntuacion) VALUES
(2, 1, '¡La mejor torta de chocolate que he probado!', 5),
(3, 2, 'Las galletas estaban deliciosas.', 4);

-- Insertar contenido exclusivo de prueba
INSERT INTO ContenidoExclusivo (titulo, descripcion, imagen) VALUES
('Receta de Torta de Chocolate', 'Aprende a hacer nuestra famosa torta de chocolate.', 'receta_torta.jpg');