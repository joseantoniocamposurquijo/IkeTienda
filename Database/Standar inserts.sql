INSERT INTO `categorias` (`CaId`, `CaDescripcion`, `CaIcono`, `created_at`) VALUES ('BLL', 'Belleza y cuidado personal', 'fas fa-spa', '2021-08-23 22:08:05');
INSERT INTO `categorias` (`CaId`, `CaDescripcion`, `CaIcono`, `created_at`) VALUES ('ELC', 'Electrodomesticos', 'fas fa-blender', '2021-08-23 22:07:45');
INSERT INTO `categorias` (`CaId`, `CaDescripcion`, `CaIcono`, `created_at`) VALUES ('HOG', 'Hogar y Muebles', 'fas fa-home', '2021-08-23 16:27:12');
INSERT INTO `categorias` (`CaId`, `CaDescripcion`, `CaIcono`, `created_at`) VALUES ('HOM', 'Ropa y Accesorios', 'fas fa-tshirt', '2021-08-23 16:31:26');
INSERT INTO `categorias` (`CaId`, `CaDescripcion`, `CaIcono`, `created_at`) VALUES ('TEC', 'Tecnología', 'fas fa-laptop', '2021-08-22 09:21:52');
INSERT INTO `categorias` (`CaId`, `CaDescripcion`, `CaIcono`, `created_at`) VALUES ('VDJ', 'Video Juegos', 'fas fa-gamepad', '2021-08-23 22:08:15');

INSERT INTO `productos` (`PrId`, `PrNombre`, `PrPrecio`, `PrDescripcion`, `PrImagen`, `PrCategoria`, `PrDescuento`) VALUES ('1', 'Celular marca Pollito 2100', '500.00', 'Celular para llamar a cualquier persona con todas las funcionalidades de redes sociales, incluye bateria y cargador', 'img1.jpg', 'TEC', 30);

INSERT INTO `inventarios` (`InId`, `InProductoId`, `InCantidad`) VALUES ('1', '1', '5');

INSERT INTO `roles` (`RoId`, `RoDescription`) VALUES ('Ad', 'Administrador');
INSERT INTO `roles` (`RoId`, `RoDescription`) VALUES ('Us', 'Usuario');

INSERT INTO `usuarios` (`UsAlias`, `UsRol`, `UsNombres`, `UsApellidos`, `UsCorreo`, `UsPassword`, `UsDireccion`, `UsTelefono`) VALUES ('admin', 'Ad', 'Administrador', 'Sistema', 'adminSystem@yopmail.com', 'ee4e6acb2dcd27e2a7cdcddac907c46f64c7fff45eba6c3e22d93c3112bcc510db62ed5c68f1bfa58e63194b026e2784b082a38c240bf004823639c7260d0290', 'Calle 100 90 - 80', '3115695537');
