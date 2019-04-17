# Arhitectura aplicatiei
# Online Contacts

**1.Functionalitati:**  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proiectul consta intr-o aplicatie Web care sa reprezinte un manager de contacte personale.  
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Principalele functionalitati sunt:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-logarea: pentru a avea acces la functionalitatile aplicatiei este necesar ca utilizatorul sa se logheze. Dupa introducerea email-ului si al parolei se verifica daca contul se afla in baza de date, iar in caz afirmativ, utilizatorului ii este permis accesul la site.  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-inregistrare: pentru a avea acces la functionalitatile aplicatiei este necesar ca utilizatorul sa-si creeze un cont, fiind stocate in baza de date anumite informatii despre utilizator, cum ar fi: id, nume, prenume, parola.  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-crearea unui contact: aceasta functie preia anumite detalii despre utilizator (nume, prenume, adresa, zi de nastere, email, descriere) si le introduce in baza de date;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-editarea unui contact: pe pagina de Contacts va aparea un buton care implementeaza aceasta functie care primeste ca parametru id-ul unui contact, verifica daca contactul se afla in baza de date, iar in caz afirmativ il returneaza cu noile modificari;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-stergerea unui contact: tot pe pagina de Contacts este un buton care executa aceasta functie care primeste ca parametru id-ul contactului si il sterge din baza de date;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-vizualizare detalii contact: functia primeste ca parametru id_contactului si returneaza informatii privitoare la acesta;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-sortare contacte: aceasta functie faciliteaza cautarea unor anumite contacte de catre un utilizator prin sortarea lor dupa propriile criterii;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-filtrarea contactelor: functia returneaza o lista de contacte asupra carora au fost efectuate anumite operatii, cum ar fi: obtinerea persoanelor mai tinere de 20 de ani localizate in Iasi;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-creare grup: prin intermediul acestei functii se creeaza un grup pentru contacte si sunt stocate in baza de date informatii privitoare la numele grupului, data crearii si descriere;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-adaugarea unui contact la un anumit grup: aceasta functie primeste ca parametru id-ul contactului si introduce in baza de date in tabela Group respectivul contact;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-editare profil: aceasta functie permite utilizatorului sa modifice sau sa introduca noi date personale;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-cautare informatii: aceasta functionalitate faciliteaza gasirea de informatii din intreaga aplicatie;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-export: prin intermediul acestei functionalitati sunt exportate informatii in diferite formate, cum ar fi: CSV, Atom.  
  
**2.Autentificare:**  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Metoda aleasa pentru a persista utilizatorii logati este folosirea unui JSON Web Token prin intermediul caruia criptam ID-ul utilizatorilor logati, pentru a valida autenticitatea utilizatorului. Odată ce utilizatorul este conectat, fiecare solicitare ulterioară va include JWT, permițând utilizatorului să acceseze rute, servicii și resurse care sunt permise cu acest jeton. JWT este un tip de autentificare bazată pe token. Un token este codificat folosind un secret. Ori de câte ori clientul trimite acest token împreună cu o solicitare, serverul îl validează si poate garanta că datele pe care le conține pot fi de încredere deoarece cererea este semnată cu ID-ul unic. Simbolurile JWT pot primi un timp de expirare. Ele pot fi, de asemenea, generate fără expirare, însă este cea mai bună practică de a ne asigura că jetoanele au expirat și s-au reînnoit la anumite intervale. Acest lucru va preveni atacuri ce au la baza furturi ale JWT-ului.
