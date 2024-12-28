### **`Dashboard Adventureworks`**

---

### **`Oleh`**

- **Talia Aprianti          [22082010035]**
- **Risda Rahmawati Harsono [22082010040]**

---
### **`Tampilan`**

![IMG-20241228-WA0003](https://github.com/user-attachments/assets/086fcddf-014f-4474-9248-737456e178c5)

![IMG-20241228-WA0005](https://github.com/user-attachments/assets/fb821c9d-1890-47e2-bdd6-7e0db719e12b)

![IMG-20241228-WA0002](https://github.com/user-attachments/assets/1f153210-5da8-4a51-978d-4716f7a2d90b)

---
### **`Langkah-Langkah Menjalankan Aplikasi Website`**

1. Install XAMPP, bila belum memiliki bisa download di link berikut [link](https://www.apachefriends.org/download.html)
2. Download Seluruh file **trdash** di repository github ini
3. Ekstrak folder **trdash** yang sudah di download dari repository dan pindahkan ke folder xampp/htdocs
4. Download file apache core zip di [link](https://tomcat.apache.org/download-90.cgi)
5. Ekstrak folder apache di penyimpanan D:\
6. Akses folder **trdash** di htdocs dan copy folder mondrian
7. Alses folder **trdash** di htdocs, masuk ke folder mondrian dan ambil file index.jsp dan index.html lalu copy
8. Akses folder **apache/webapps/mondrian** dan paste
9. Akses folder **trdash** di htdocs, masuk ke folder mondrian dan ambil file schpurchasing.xml, schsales.xml, whpurchasing.jsp & whsales.jsp lalu copy
10. Akses folder **apache/webapps/mondrian/WEB-INF/queries** dan paste
11. Buka XAMPP Panel Control kemudian nyalakan 'apache' dan 'mysql'
12. Akses [localhost/phpmyadmin](http://localhost/phpmyadmin/) di browser kemudian buat database schsales, schpurchasing dan schaccount
13. Buka database dan impor file sql yang ada di folder htdocs **trdash/database** dan impor schsales.sql, schpurchasing.sql, schaccount.sql sesuai dengan database yang sudah dibuat sebelumnya
14. Akses folder apache lewat Command Prompt (CMD) dan jalankan catalina run **[contoh akses di CMD: D:\apache-tomcat-9.0.97]**
15. Akses website dengan link [localhost/trdash](http://localhost/trdash/)
16. Untuk login bisa cek akun yang terdaftar dalam database **schaccount**
---
