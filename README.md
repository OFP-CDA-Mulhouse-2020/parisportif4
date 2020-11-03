# parisportif4

parieur (nom , prenom , date de naissance,  adress , ville , tel , mail , solde , mdp)
pari ( date , type)
cote ( nom, cote)
rencontre ( nom , lieu , date )
evenement ( nom )
Sport ( nom , type )

parieur 0..* ---> 1 pari


pari 1..* ----- 1 cote


cote 1..* ---> 1 rencontre 

rencontre  1..* -----> 1 Evenement

Evenement 1...*  ----->  1 Sport 
