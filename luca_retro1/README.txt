Eva Ström - WIE15-Medieinstitutet - Examensuppgift
RetroCrafts ...webbadress kommer inom kort... är en E-handel byggd i Magento 2.O med utgångspunkt i temat Luca. 
I Magento är kodstruktur och filhantering redan skapad. 
Jag har valt Magento 2.0 för att det är ett intressant och komplext system att arbeta i. Det har ett bra kundhanteringssystem 

Mappar, filer och Child-tema
Mappstrukturen är enligt följande app/design/frontend/fieldthemes/luca_retro1/retrocrafts 
På GitHub ligger mappar och filer från luca_retro1/retrocrafts uppladdat.
Ett Childtema retrocrafts är skapat vars 'parent' är luca_retro1-temat vars 'parent' är blank. 

Under arbetet
Svårigheten har varit att få support och vägledning. 
Befintliga Magento-forum och grupper har varit min support. 
Harald Notini hjälpte mig att installera temat rätt. 

Databas mySQL Workbench
Databasen har 'kraschat' en gång. Jag lyckades rädda och återställa den lokalt i MySQL Workbench. 
RetroCrafts som E-shop är tänkt att fungera fullt ut som en E-handel on-line. 

Lagt till Instagram samt >SWIPE> mellan pilarna i de mindre karusellerna på indexsidan. Släpper det så långe.
20 mars. Får inte '>Swipe< att funka. Lägger fokus på produktsidor, checkout och payment nu. 

Har lagt till en fil för css progressbar. Det finns en sådan inbyggt i Magentos-tema. Jag ville ändå få koll på hur den är uppbyggd. Jag kommer dock att använda den redan inställda funktionen. 

29 mars Har lagt in Sandbox konton för PayPal och strax ett kommande för Klarna. De läggs i Checkout. 
För PayPal finns det redan en inbyggd funktion och modul i Magento2. Paypal kopplas på med en API nyckel. Jag har ändå velat titta på vad en sådan kod kan innehålla och lagt upp dessa mappar och filer är de utgår från code/Magento/Paypal...+ mapp och kodstruktur. För Klarna modul har jag varit i kontakt med Nordic Web Team. De verkar veta lite mer om Klarna-anpassning för Magento2. Klarna och flera som jag har talat med verkar INTE gilla Magento2. 

Upptäckt en (av säkert många buggar i Magento2) Logotype i Transactional E-mails fungerar inte att ladda upp. 
Rekommenderad åtgärd: create di.xml into you custom module
add <preference for="Magento\Theme\Model\Design\Backend\Logo" type="Vendor\YouModuleName\Model\Design\Backend\Logo"/>
create the file Vendor\YouModuleName\Model\Design\Backend\Logo.php
replace the const UPLOAD_DIR = 'logo'; with const UPLOAD_DIR = 'email/logo';

Trots åtgärden ovan får jag det inte att fungera. 

4 april RetroCrafts är nu äntligen (efter några dagars mekande) SSL-certifierad och har https:// istället för http:// certifikatet ligger hos COMODO


Text kompletteras här efterhand arbetet fortgår...