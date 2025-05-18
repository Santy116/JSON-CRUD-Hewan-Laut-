CREATE TABLE hewan_laut (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    jenis VARCHAR(100) NOT NULL,
    habitat VARCHAR(100) NOT NULL,
    deskripsi TEXT
);

INSERT INTO hewan_laut VALUES
(DEFAULT, 'Hiu Paus', 'Ikan', 'Laut Tropis', 'Hiu terbesar di dunia yang bersifat filter feeder'),
(DEFAULT, 'Penyu Hijau', 'Reptil', 'Laut Tropis', 'Penyu laut yang sering ditemukan di perairan dangkal'),
(DEFAULT, 'Gurita Pasifik', 'Moluska', 'Laut Dalam', 'Gurita besar yang dikenal sangat cerdas');

