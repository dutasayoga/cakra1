SELECT p1.NIPEG nip, p1.NAMA namapegawai, p2.NIPEG nipbos, p2.NAMA nmbos
FROM person p1
LEFT JOIN person p2 ON p1.NIPEG_UP = p2.NIPEG
WHERE p2.NIPEG = "PP.8412174"

SELECT
FROM person RIGHT JOIN
(SELECT NIPEG_UP,NAMA, COUNT(*)
FROM person
GROUP BY NIPEG_UP) AS tabel2




Select E1.NAMA, ISNULL(E2.NAMA, 'No Boss') as ManagerName
From
(
(
(
     Select NIPEG, NAMA, NIPEG_UP
     From person
) AS t1
     UNION ALL
(
     Select person.NIPEG , person.NAMA,
             person.NIPEG_UP
     From person
     JOIN personCTE
     ON person.NIPEG = personCTE.NIPEG_UP
) AS t2)as t3)AS E1 LEFT JOIN t3 AS E2
ON E1.NIPEG_UP = E2.NIPEG


-- RECURSIVE FUNCTION UNTUK MENAMPILKAN SEMUA PEGAWAI DIBAWAH BAWAHAN
CREATE PROCEDURE personT1
AS
SELECT person.NIPEG, person.NAMAm person.NIPEG_UP
FROM person
GO;

select
	 p7.NAMA as bos3nama,
	p6.NAMA as bos3nama,
	p5.NAMA as bos3nama,
	p4.NAMA as bos3nama,
	p3.NAMA as bos2nama,
	p2.NAMA as bosnama,
    p1.NAMA as emp
from person p1
left join person p2
ON p1.NIPEG_UP = p2.NIPEG
left join person p3
on p2.NIPEG_UP = p3.NIPEG
left join person p4
on p3.NIPEG_UP = p4.NIPEG
left join person p5
on p4.NIPEG_UP = p5.NIPEG
left join person p6
on p5.NIPEG_UP = p6.NIPEG
left join person p7
on p6.NIPEG_UP = p7.NIPEG


select NAMA from person

select
