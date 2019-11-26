# UnderStending
UnderStending

## Stappen om de git repository op je pc te krijgen
1. Installeer git op je pc https://git-scm.com
2. Stap A als de editor een terminal heeft, stap B als je netbeans hebt.
2. A.) Clone de git repository naar een map op je pc door in de command line van windows het volgende uit te voeren `git clone https://github.com/JesperKuipers/UnderStending.git`                 https://github.com/JesperKuipers/TUS-Schoonebeek.git`
2. B.) Download github desktop op je pc https://desktop.github.com/
  
  

## Hoe te werken met git terminal (sla deze stap over als github desktop wordt gebruikt)

1. Open je code editor op je pc (Een editor met terminal is een pré)
2. Om de nieuwste versie van de code te krijgen voer je de volgende commando's uit:
`git checkout master` en `git pull`
3. Om iets aan te passen aan de code is het goed om in een andere branch te gaan werken, zodat git kan zien wat er aangepast wordt. Om die branch aan te maken voeren we het volgende commando uit: 
`git checkout -b "plaats hier je nieuwe branchnaam"`
4. We werken nu met deze nieuwe fantastische branch. Stel je voor dat er twee mensen in deze branch werken, dan willen deze twee mensen wel aan dezelfde code werken. Dus het werk moet opgeslagen worden. Het werk opslaan doen we met het volgende commando:
`git add .` en daarna
`git commit -am "Message die ik meegeef aan de commit"` en daarna `git push`
5. Als ik de nieuwste versie van de branch wil hebben doe ik `git pull`
6. Als ik in een andere branch wil werken die al bestaat dan doe ik `git checkout branchnaam`


<h4>TIP: Sla je werk regelmatig op. Als er iets fout gaat in je code en je weet niet waarom, dan kan je één of meerdere commits terug gaan. Ik ben niet Joke van Astro TV maar waarschijnlijk gaan we dit zeer vaak gebruiken</h4>
