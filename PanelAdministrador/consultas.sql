SELECT * FROM compra WHERE id_user=1
ORDER BY id_compra DESC 
LIMIT 1;
SELECT id_compra FROM compra WHERE id_user=1 ORDER BY id_compra DESC LIMIT 1;

SELECT nombre_pr, precio_uni, (12*(precio_uni-precio_uni*descuento)) FROM productos WHERE id_product=1;
INSERT INTO detalles_compra (id_compra,id_product,qty,total) VALUES ((SELECT id_compra FROM compra WHERE id_user=1 ORDER BY id_compra DESC LIMIT 1),1,12, (SELECT (12*(precio_uni-precio_uni*descuento)) FROM productos WHERE id_product=1));

SELECT * FROM detalles_compra;
SELECT dc.*, p.nombre_pr,p.precio_uni FROM detalles_compra as dc INNER JOIN productos as p on dc.id_product=p.id_product WHERE dc.id_compra =(SELECT id_compra FROM compra WHERE id_user=1 ORDER BY id_compra DESC  LIMIT 1)
	ORDER BY dc.fecha_add DESC  LIMIT 1;

SET @qty = (SELECT (stock-12) FROM productos WHERE id_product=1);
SELECT if(@qty>0,'s','n')
END IF;

UPDATE productos SET stock=@qty WHERE id_product=1;

UPDATE productos SET stock=1000 WHERE stock<500;

SELECT COUNT(u.id_usuario) AS NUsuarios FROM usuarios AS u, compra AS c;

SELECT SUM(s.qty) AS qty,MONTH(s.date) AS month_date,p.name, SUM(p.sale_price * s.qty) AS total_saleing_price 
FROM sales AS s INNER JOIN products AS p ON s.product_id=p.id
WHERE YEAR(s.date) = '2022'
GROUP BY MONTH(s.date), p.id
ORDER BY MONTH(s.date) ASC

SELECT COUNT(c.id_compra) AS conteomensual, MONTH(c.sale_date) AS messale
FROM compra AS c
WHERE YEAR(c.sale_date)='2022'
GROUP BY messale
ORDER BY MONTH(c.sale_date) ASC

SELECT COUNT(c.id_compra) AS conteomensual, DAY(c.sale_date) AS daysale
FROM compra AS c
WHERE YEAR(c.sale_date)='2022' AND MONTH(c.sale_date)='6'
GROUP BY daysale
ORDER BY DAY(c.sale_date) ASC


(SELECT (12*(precio_uni-precio_uni*descuento)) FROM productos WHERE id_product=12)

SELECT c.*, u.user_name FROM compra AS c INNER JOIN usuarios AS u ON c.id_user=u.id_usuario 
SELECT CURRENT_TIMESTAMP()

SELECT dc.id_product, p.nombre_pr, dc.qty, p.precio_uni, dc.total 
FROM detalles_compra AS dc INNER JOIN productos AS p ON dc.id_product=p.id_product
WHERE dc.id_compra=1

SELECT p.nombre_pr, SUM(dc.qty) AS sumacantidad
FROM detalles_compra AS dc 
INNER JOIN productos AS p ON dc.id_product=p.id_product 
INNER JOIN compra AS c ON dc.id_compra=c.id_compra
WHERE c.is_pend='1' AND YEAR(c.sale_date)='2022'
GROUP BY p.id_product
LIMIT 10

SELECT dc.*, p.nombre_pr,p.precio_uni FROM detalles_compra as dc INNER JOIN productos as p on dc.id_product=p.id_product WHERE dc.id_compra =(SELECT id_compra FROM compra WHERE id_user=1 ORDER BY id_compra DESC  LIMIT 1)
		ORDER BY dc.fecha_add DESC  LIMIT 1;
		
SELECT * FROM productos WHERE id_product

SELECT dc.qty,dc.total, p.nombre_pr,p.precio_uni, (p.descuento*100) AS desuentopr, c.total
FROM detalles_compra AS dc
INNER JOIN compra AS c ON dc.id_compra=c.id_compra
INNER JOIN productos AS p ON dc.id_product=p.id_product
WHERE c.id_compra=45

SELECT p.nombre_pr, SUM(dc.qty) AS sumacantidad
FROM detalles_compra AS dc 
INNER JOIN productos AS p ON dc.id_product=p.id_product 
INNER JOIN compra AS c ON dc.id_compra=c.id_compra
WHERE c.is_pend='1' AND YEAR(c.sale_date)='2022'
GROUP BY p.id_product
LIMIT 10

SELECT pc.nombre_cat, COUNT(c.id_compra) AS conteocompras
FROM p_categoria AS pc INNER JOIN productos AS p ON pc.id_cat=p.id_cat
INNER JOIN detalles_compra AS dc ON p.id_product=dc.id_product
INNER JOIN compra AS c ON dc.id_compra=c.id_compra
WHERE c.is_pend='1' AND YEAR(c.sale_date)='2022'
GROUP BY pc.id_cat

SELECT (1*(precio_uni-precio_uni*descuento)) FROM productos WHERE id_product=10

SELECT CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS nombreusuario, email FROM usuarios WHERE id_usuario=1

SELECT dc.id_product, p.nombre_pr, dc.qty, (p.precio_uni-p.precio_uni*p.descuento) AS preciocondesc, dc.total, (p.descuento*100) AS descuentopr
                                    FROM detalles_compra AS dc INNER JOIN productos AS p ON dc.id_product=p.id_product
                                    WHERE dc.id_compra=45;


SELECT CONCAT(p.id_product,' | ',p.nombre_pr) AS Search FROM productos AS p WHERE p.id_product LIKE '%1%' OR p.nombre_pr LIKE '%Ã±%' LIMIT 5


SELECT u.id_usuario, CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS nombrecompleto, u.user_name, u.email, r.nombre_rol 
                            FROM usuarios AS u INNER JOIN rol AS r ON u.user_rol=r.id_rol
                            WHERE u.is_active='1'
                            
SELECT EXISTS(SELECT * FROM usuarios WHERE (user_name LIKE 'admin' OR email LIKE 'admin@mail.com' ) 
AND id_usuario!=1) AS existencia 

SELECT p.nombre_pr, SUM(dc.qty) AS sumacantidad
    FROM detalles_compra AS dc 
    INNER JOIN productos AS p ON dc.id_product=p.id_product 
    INNER JOIN compra AS c ON dc.id_compra=c.id_compra
    WHERE c.is_pend='1' AND YEAR(c.sale_date)='2022'
    GROUP BY p.id_product
    ORDER BY sumacantidad DESC
    LIMIT 10
    
    
    SELECT IF(EXISTS(SELECT * FROM usuarios WHERE user_name='admn' OR email='adminaa'),1,0) AS existencia