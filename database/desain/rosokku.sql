/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     8/28/2020 10:29:58 AM                        */
/*==============================================================*/


drop table if exists alamat;

drop table if exists detail_rute;

drop table if exists jadwal;

drop table if exists kategori;

drop table if exists keuangan;

drop table if exists kurir;

drop table if exists pelanggan;

drop table if exists request_saldo;

drop table if exists rute;

drop table if exists transaksi;

/*==============================================================*/
/* Table: alamat                                                */
/*==============================================================*/
create table alamat
(
   id_alamat            int not null auto_increment,
   id_pelanggan         int,
   alamat               varchar(128),
   latitude             decimal(11,8),
   longitude            decimal(11,8),
   primary key (id_alamat)
);

/*==============================================================*/
/* Table: detail_rute                                           */
/*==============================================================*/
create table detail_rute
(
   id_detail_rute       int not null auto_increment,
   id_transaksi         int,
   id_rute              int not null,
   urutan               int,
   primary key (id_detail_rute)
);

/*==============================================================*/
/* Table: jadwal                                                */
/*==============================================================*/
create table jadwal
(
   id_jadwal            int not null auto_increment,
   hari                 varchar(10),
   start                int,
   end                  int,
   start_date           date,
   end_date             date,
   primary key (id_jadwal)
);

/*==============================================================*/
/* Table: kategori                                              */
/*==============================================================*/
create table kategori
(
   id_kategori          int not null auto_increment,
   nama                 varchar(80),
   harga                decimal(19,2),
   primary key (id_kategori)
);

/*==============================================================*/
/* Table: keuangan                                              */
/*==============================================================*/
create table keuangan
(
   id_keuangan          int not null auto_increment,
   tanggal              date,
   keterangan           varchar(50),
   nominal              decimal(19,2),
   tipe                 varchar(6),
   primary key (id_keuangan)
);

/*==============================================================*/
/* Table: kurir                                                 */
/*==============================================================*/
create table kurir
(
   id_kurir             int not null auto_increment,
   nama                 varchar(80),
   alamat               varchar(128),
   phone                varchar(20),
   email                varchar(100),
   password             varchar(128),
   primary key (id_kurir)
);

/*==============================================================*/
/* Table: pelanggan                                             */
/*==============================================================*/
create table pelanggan
(
   id_pelanggan         int not null auto_increment,
   nama                 varchar(80),
   phone                varchar(20),
   rekening             varchar(30),
   bank                 varchar(20),
   email                varchar(100),
   password             varchar(128),
   primary key (id_pelanggan)
);

/*==============================================================*/
/* Table: request_saldo                                         */
/*==============================================================*/
create table request_saldo
(
   id_request_saldo     int not null auto_increment,
   id_keuangan          int,
   id_pelanggan         int not null,
   tanggal              date,
   saldo                decimal(19,2),
   status               varchar(10),
   primary key (id_request_saldo)
);

/*==============================================================*/
/* Table: rute                                                  */
/*==============================================================*/
create table rute
(
   id_rute              int not null auto_increment,
   id_kurir             int,
   tanggal              date,
   primary key (id_rute)
);

/*==============================================================*/
/* Table: transaksi                                             */
/*==============================================================*/
create table transaksi
(
   id_transaksi         int not null auto_increment,
   id_kategori          int,
   id_kurir             int,
   id_jadwal            int not null,
   id_pelanggan         int not null,
   harga_satuan         decimal(19,2),
   berat                decimal(5,2),
   foto                 varchar(50),
   tanggal_ambil        date,
   latitude             decimal(11,8),
   longitude            decimal(11,8),
   status               varchar(10),
   primary key (id_transaksi)
);

alter table alamat add constraint fk_mempunyai_alamat foreign key (id_pelanggan)
      references pelanggan (id_pelanggan) on delete restrict on update restrict;

alter table detail_rute add constraint fk_mempunyai_urutan_pengambilan foreign key (id_transaksi)
      references transaksi (id_transaksi) on delete restrict on update restrict;

alter table detail_rute add constraint fk_mempunyai_urutan_rute foreign key (id_rute)
      references rute (id_rute) on delete restrict on update restrict;

alter table request_saldo add constraint fk_mempunyai_catatan_keuangan foreign key (id_keuangan)
      references keuangan (id_keuangan) on delete restrict on update restrict;

alter table request_saldo add constraint fk_mencairkan_saldo foreign key (id_pelanggan)
      references pelanggan (id_pelanggan) on delete restrict on update restrict;

alter table rute add constraint fk_menempuh_rute foreign key (id_kurir)
      references kurir (id_kurir) on delete restrict on update restrict;

alter table transaksi add constraint fk_mempunyai_jadwal foreign key (id_jadwal)
      references jadwal (id_jadwal) on delete restrict on update restrict;

alter table transaksi add constraint fk_mempunyai_kategori foreign key (id_kategori)
      references kategori (id_kategori) on delete restrict on update restrict;

alter table transaksi add constraint fk_mempunyai_transaksi foreign key (id_pelanggan)
      references pelanggan (id_pelanggan) on delete restrict on update restrict;

alter table transaksi add constraint fk_mengambil_barang foreign key (id_kurir)
      references kurir (id_kurir) on delete restrict on update restrict;

