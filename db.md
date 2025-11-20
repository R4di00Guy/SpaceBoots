# Database 
## Tables:
### Unit(product)
### Client
### Orders
### 
a=[]
try:
    f=int(input("ilie liczb? "))
    try:
        for i in range(0,f):
            a.append(int(input(f"wpisz liczbe {i+1}: ")))
    except:
        print("to nie liczba")
    a=sorted(a)
    for i in range(0,len(a)):
        print(a[i],end=", ")
except:
    print("to nie liczba")
