create table admin (
    nip int(25) not null,
    nama varchar(255),
    username varchar(255),
    password varchar(255),
    role enum('admin', 'pembina')
);
alter table admin
    add primary key (nip);

insert into admin values (1, 'Administrator', 'admin', 'admin', 'admin');

create table kelas (
    id_kelas int(11) not null,
    nama varchar(255)
);
alter table kelas
    add primary key (id_kelas),
    modify id_kelas int(11) not null auto_increment;

create table siswa (
    nis int(11) not null,
    kelas_id int(11) not null,
    nama varchar(255),
    gender enum('L', 'P'),
    alamat varchar(255),
    email varchar(255),
    password varchar(255),
    angkatan varchar(255),
    status enum('aktif', 'tidak'),
    role enum('junior', 'senior'),
    level enum('allow', 'denied')
);
alter table siswa 
    add primary key (nis),
    add constraint relasi1 foreign key (kelas_id) references kelas (id_kelas);

create table nilai (
    id_nilai int(11) not null,
    nama varchar(255)
);
alter table nilai
    add primary key (id_nilai),
    modify id_nilai int(11) not null auto_increment;

create table thn_pelajaran (
    id_tahun int(11) not null,
    tahun_awal varchar(255),
    tahun_akhir varchar(255)
);
alter table thn_pelajaran
    add primary key (id_tahun),
    modify id_tahun int(11) not null auto_increment;

create table detail_nilai (
    id_detail int(11) not null,
    nilai_id int(11) not null,
    tahun_id int(11) not null,
    total_nilai int(255),
    created_at datetime
);
alter table detail_nilai
    add primary key (id_detail),
    modify id_detail int(11) not null auto_increment,
    add constraint relasi2 foreign key (nilai_id) references nilai (id_nilai),
    add constraint relasi3 foreign key (tahun_id) references thn_pelajaran (id_tahun);

create table entered (
    id_enter int(11) not null,
    nip int(25) not null,
    nis int(11) not null,
    detail_id int(11) not null
);
alter table entered
    add primary key (id_enter),
    modify id_enter int(11) not null auto_increment,
    add constraint relasi4 foreign key (nip) references admin (nip),
    add constraint relasi5 foreign key (nis) references siswa (nis),
    add constraint relasi6 foreign key (detail_id) references detail_nilai (id_detail);

commit;
