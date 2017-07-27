# DOKUMENTASI APLIKASI CHAT

## DESKRIPSI
Aplikasi untuk chat.  

Fitur :
- chatting
- membuat grup

## CARA INSTALASI
- Download dan install Node JS.
- Download dan install XAMPP.
- Jalankan file sql untuk database yang terdapat pada CHATv2\application 
- Download atau clone CHATv2 letakkan pada htdocs
- Ubah konfigurasi Codeigniter yg terdapat di file config, ubah sesuai alamat dan port php
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<pre>
		$config['base_url'] = 'http://localhost:8000/TrustChatV1/';  
	</pre>
- Ubah konfigurasi database yg terdapat di file database, sesuai dengan database yang digunakan.
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	<pre> 
		$config['base_url'] = $db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => 'postgres',
		'password' => 'root',
		'database' => 'COBA',
		'dbdriver' => 'postgre',  
	</pre>
- Dengan CMD , jalankan file package.json pada CHATv2\server , install dg npm install
	<pre>
	npm install
	</pre>
- ubah port chat server pada server.js sesuai keinginan, namun juga ubah port pada VIEW
- jalankan chat server dengan perintah node server.js
- akses aplikasi di browser alamat:port/CHATv2
- login
