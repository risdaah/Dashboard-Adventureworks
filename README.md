### **`Dashboard Adventureworks`**

---

### **`Oleh`**

- **Talia Aprianti          [22082010035]**
- **Risda Rahmawati Harsono [22082010040]**

---
### **`Tampilan`**

Isi disini 
---
### **`Langkah-Langkah Menjalankan Aplikasi Website`**

1. Install XAMPP, bila belum memiliki bisa download di link berikut [link](https://www.apachefriends.org/download.html)
2. Download Seluruh file **trdash** di repository github ini
3. Ekstrak folder **trdash** yang sudah di download dari repository dan pindahkan ke folder xampp/htdocs
4. Download file apache core zip di [link](https://tomcat.apache.org/download-90.cgi)
5. Ekstrak folder apache di penyimpanan /:D
6. Akses folder **trdash** di htdocs dan copy folder mondrian
7. Akses di folder apache yang sudah di download sebelumnya, masuk ke folder webapps dan paste folder mondrian
8. Alses folder **trdash** di htdocs, masuk ke folder mondrian dan ambil file index.jsp dan index.html lalu copy
9. Akses folder **apache/webapps/mondrian** dan paste
10. Akses folder **trdash** di htdocs, masuk ke folder mondrian dan ambil file schpurchasing.xml, schsales.xml, whpurchasing.jsp & whsales.jsp lalu copy
11. Akses folder **apache/webapps/mondrian/WEB-INF/queries** dan paste
12. Buka XAMPP Panel Control kemudian nyalakan 'apache' dan 'mysql'
13. Akses (localhost/phpmyadmin) di browser kemudian buat database schsales, schpurchasing dan schaccount
14. Buka database dan impor file sql yang ada di folder htdocs **trdash/database** dan impor schsales.sql, schpurchasing.sql, schaccount.sql sesuai dengan database yang sudah dibuat sebelumnya
15. Akses folder apache lewat Command Prompt (CMD) dan jalankan catalina run [contoh akses di CMD: D:\apache-tomcat-9.0.97]
16. Akses website dengan link (localhost/trdash)
---
