import tkinter as tk
 
OptionList1 = [
"USD",
 
]
 
OptionList2 = [
"indianrs",
"srilankars",
]
 
def Ok():
 
    fr = variable.get()
    to = variable1.get()
 
    amount = float(e1.get())
 
    if (fr == "USD" and to == "indianrs"):
 
        tot = amount * 180
 
    else:
        tot = amount * 120
 
    nsalText.set(tot)
 
root = tk.Tk()
root.geometry('300x200')
root.title("Currency Converver System Python")
 
variable = tk.StringVar(root)
variable.set(OptionList1[0])
 
opt = tk.OptionMenu(root, variable, *OptionList1)
opt.config(width=10, font=('Helvetica', 12))
opt.pack(side="top")
 
variable1 = tk.StringVar(root)
variable1.set(OptionList2[0])
 
opt = tk.OptionMenu(root, variable1, *OptionList2)
opt.config(width=10, font=('Helvetica', 12))
opt.pack(side="top")
 
global e1
global nsalText
nsalText = tk.StringVar()
labelTest = tk.Label(text="", font=('Helvetica', 12), fg='red')
labelTest.pack(side="top")
 
 
tk.Label(root, text="From").place(x=10, y=10)
tk.Label(root, text="To").place(x=10, y=40)
tk.Label(root, text="Amount").place(x=10, y=80)
 
tk.Label(root, text="Total:").place(x=10, y=150)
tk.Label(root, text="", font=('Helvetica', 12), fg='red' , textvariable=nsalText).place(x=100, y=150)
tk.Button(root, text="Cal", command=Ok ,height = 1, width = 3).place(x=100, y=110)
 
e1 = tk.Entry(root)
e1.place(x=80, y=80)
 
root.mainloop()