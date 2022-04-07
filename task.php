<?php

//Pārdošanas procesā preču kodus tipiski veido ciparu u.c. simbolu virkne, taču gadījumā,
// ja precei iespējami dažādi veidi/izmēri (“variācijas”), to veido, papildus kombinējot
// preces kodu ar šo variāciju kodiem. Piemēram T-krekls ar uzrakstu “Rīga”, kura preces
// kods ir “051315”, kopā ar variācijām “sarkans” un “izmērs - M” varētu izskatīties šādi:
// “051315.RED.M”. Tātad “051315.RED.M” apraksta konkrētu t-krekla izmēru un krāsu, kamēr
// viens pats kods “051315" apzīmē t-krekla veidu vai sēriju (“Rīga”).

//Pielikumā pievienoju JSON formāta failu ar precēm un to iespējamām variācijām. Uzdevums: izveidot ekrāna formu,
// kurā iespējams no saraksta izvēlēties preci, kas aktivizē šai precei piesaistītās iespējamās variāciju izvēles
// (piemērā pēc T-krekla “Rīga” izvēles parādītos papildu izvēlnes ar krāsas un izmēra variantiem). Kad lietotājs
// izvēlējies visas variācijas, jāattēlo saliktais preces kods.
//
//Pievienotā faila struktūra:
//* “varieties” bloks - apraksta visas iespējamās variācijas
//* “items” bloks - apraksta pieejamās preces un to, kādas variācijas no iepriekšējā bloka tām piemērojamas
