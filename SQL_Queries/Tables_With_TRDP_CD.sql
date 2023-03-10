SELECT * FROM INFORMATION_SCHEMA.COLUMNS 
WHERE COLUMN_NAME LIKE '%REF_NO%' AND (TABLE_NAME LIKE 'TB%' OR TABLE_NAME LIKE 'VIS%')
ORDER BY TABLE_NAME