import mysql.connector

conn = mysql.connector.connect(host="localhost", user="root", password="admin", database="website_db")
cursor = conn.cursor()
cursor.execute("SELECT * FROM media")
for row in cursor.fetchall():
    print(row)
conn.close()