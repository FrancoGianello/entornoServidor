# nombre = input("introduce tu nombre: ")

# if nombre!="":
#     print("hola "+nombre)
#     print(f"hola {nombre}")
# else:
#     print("pon algo hombre")

peso = float(input("introduce tu peso: "))
altura = float(input("introduce tu altura en metros: "))
IMC = peso / pow(altura, 2)

if IMC>20:
    print("estas bien")
else:
    print("tambien estas bien")
print("el imc es una mentira de todos modos")