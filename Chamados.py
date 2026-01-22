import tkinter as tk
import mariadb
import sys
from PIL import Image, ImageTk


config = {
    "host" : "127.0.0.1",
    "port" : 3306,
    "user" : "andre",
    "password": "12345",
    "database":"gerenciador"
    }

try: 
    conn = mariadb.connect(**config)
    print("Successfully connected to MariaDB")
except mariadb.Error as e:
    print(f"Error connecting to MariaDB: {e}")
    sys.exit(1)


cur = conn.cursor()

def on_button_click():
    print("Okay fazendo chamado")

root = tk.Tk()
root.title("Chamados")
root.configure(background = "white")
root.minsize(860,640)
imagem = Image.open("fundo.png")  
imagem = imagem.resize((860, 640))
bg_image = ImageTk.PhotoImage(imagem)


background = tk.Label(root, image=bg_image)
background.place(x=0, y=0, relwidth=1, relheight=1)

root.geometry("300x300+50+50")
button = tk.Button(root, text ="Fazer Chamado", command=on_button_click)
def fechar():
 root.destroy()
 print("fechando programa")
button1= tk.Button(root, text = "Sair", command=fechar)


button1.pack()
button.pack()
button.place(x=350, y=95, width=150, height=60)
button1.place(x=350, y=240, width= 150, height =60)
root.mainloop()


