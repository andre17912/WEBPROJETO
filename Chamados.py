import tkinter as tk
import mariadb
import sys
from tkinter import messagebox
from PIL import Image, ImageTk
from dotenv import load_dotenv
from tkinter import ttk
import os

load_dotenv()

print("HOST:", os.getenv("DB_HOST"))
print("PORT:", os.getenv("DB_PORT"))



db_host = os.getenv('DB_HOST')
db_port = int(os.getenv('DB_PORT'))
db_user = os.getenv('DB_USER')
db_password = os.getenv('DB_PASSWORD')
db_name = os.getenv('DB_NAME')


config = {
    "host": db_host,
    "port": db_port,
    "user": db_user,
    "password": db_password,
    "database": db_name
}


try:
    conn = mariadb.connect(**config)
    print("Conexão bem-sucedida ao banco de dados!")
except mariadb.Error as e:
    print(f"Erro ao conectar: {e}")
    sys.exit(1)

cur = conn.cursor()

def enviar():
    print("enviando chamado")
    texto = text_box.get("1.0", tk.END).strip()

    if texto:
        try:
            cur.execute(
                "INSERT INTO chamados (descricao) VALUES (%s)",
                (texto,)
            )
            conn.commit()
            messagebox.showinfo("Mensagem", "Mensagem enviada com sucesso!")
            text_box.delete("1.0", tk.END)

        except mariadb.Error as e:
            messagebox.showerror("Erro", f"Erro ao enviar chamado: {e}")
    else:
        messagebox.showwarning("Aviso", "Você deve inserir algo")

def on_button_click():
    print("Okay, fazendo chamado")
    continuar = messagebox.askquestion("Chamado", "Formulário para envio de chamados, deseja continuar?")
    
    if continuar == 'yes':
        root2 = tk.Toplevel(root)
        root2.title("Fazendo Chamado")
        root2.configure(background="white")
        root2.minsize(860, 640)
        root2.maxsize(860, 640)
        sep = ttk.Separator(root2, orient ="horizontal")
        sep.pack(side="bottom", fill="x", pady=15)
        
        global text_box  
        text_box = tk.Text(root2, height=20, width=45)
        text_box.pack(pady=20)

        button2 = tk.Button(root2, text="Enviar", command=enviar)
        button2.place(x=600, y=240, width=150, height=60)
    else:
        print("Fechando janela")

root = tk.Tk()
root.title("Chamados")
root.configure(background="white")
root.minsize(860, 640)
root.maxsize(860, 640)


imagem = Image.open("fundo.png")
imagem = imagem.resize((860, 640))
bg_image = ImageTk.PhotoImage(imagem)

background = tk.Label(root, image=bg_image)
background.place(x=0, y=0, relwidth=1, relheight=1)


button = tk.Button(root, text="Fazer Chamado", command=on_button_click)
button.place(x=350, y=95, width=150, height=60)


def fechar():
    root.destroy()
    print("Fechando programa")

button1 = tk.Button(root, text="Sair", command=fechar)
button1.place(x=350, y=240, width=150, height=60)


root.mainloop()


conn.close()
