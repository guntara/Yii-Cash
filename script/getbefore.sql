SELECT * FROM tbl_sales_report WHERE YEAR(`due_date`) = YEAR(now()) AND MONTH(`due_date`) = MONTH(DATE_SUB(NOW(), INTERVAL 1 MONTH)) ORDER BY `due_date`
