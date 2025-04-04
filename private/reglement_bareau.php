<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

// Vérification que l'utilisateur a les droits
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']['role'], $roles_justice)) {
    header("Location: /views/accueil.php");
    exit;
}

?>

<body>

    <!-- ✅ Conteneur principal -->
    <div class="main-content">
        <h1>Réglement et Fonctionnement du Barreau</h1>

        <div class="section-container">

            <div class="card"> Sommaire
                <div class="btn-container">
                <a class="btn-sommaire" href="#regle"> 📜 Réglement général du barreau </a>
                    <a class="btn-sommaire" href="#civile"> 👤Plaintes Civiles </a>
                    <a class="btn-sommaire" href="#entreprise"> 🏭 Plaintes Entreprises </a>
                    <a class="btn-sommaire" href="#sp"> 🏥 Plaintes Services Publiques </a>
                    <a class="btn-sommaire" href="#contrat"> 📄 Contrats </a>
                    <a class="btn-sommaire" href="#tarif"> 💸 Grille tarifaires </a>
                    <a class="btn-sommaire" href="#pj"> 🛡️ Protection Juridique </a>
                    <a class="btn-sommaire" href="#barreau"> 🎓 Examen du barreau </a>
                    <a class="btn-sommaire" href="#famille"> 💍 Procédure Familiale </a>
                    <a class="btn-sommaire" href="#compa"> ⏳ Comparutions immédiates </a>
                    <a class="btn-sommaire" href="#jugement"> 👨‍⚖️ Jugement </a>
                    <a class="btn-sommaire" href="#juge"> ⚖️ Déroulement d'un jugement </a>
                    <a class="btn-sommaire" href="#patriot"> 🛡️ U.S. Patriot Act </a>
                    <a class="btn-sommaire" href="#rico"> 🚔 Loi R.I.C.O. </a>
                    <a class="btn-sommaire" href="#doc"> 📜 Documents Officiels du DOJ </a>
                    <a class="btn-sommaire" href="#peter"> 🔍 Perquisitions </a>
                    <a class="btn-sommaire" href="#peine"> ⚔️ Système des Peines </a>
                    <a class="btn-sommaire" href="#code"> 🟢🟠🔴⚫ Les Codes d'État </a>
                    
                </div>
            </div>

            <div class="card" id="regle">📜 Réglement général du barreau
                <ul> 
                    Pour exercer la profession d’avocat ou de procureur dans l'État de San Andreas, il est obligatoire de réussir l’examen du barreau. Ce dernier garantit que les candidats possèdent les connaissances et compétences nécessaires pour 
                    pratiquer le droit.
                    <br><br>
                    <strong> 📌 Conditions d’Accès à la Profession </strong><br><br>
                    <ul> <strong> ✅ Réussite de l’Examen du Barreau : </strong>
                    <ul> Il est obligatoire d’obtenir son barreau pour exercer comme avocat ou procureur. </ul></ul><br>
                    <ul> <strong> ✅ Expérience Préalable : </strong>
                    <ul> Un stage d’au moins une semaine doit être effectué auprès du Bureau des avocats pénalistes. </ul>
                    <ul> Le candidat doit participer à un jugement fictif organisé par le BAP ou le DOJ.</ul></ul> <br>
                    <ul> <strong> ✅ Casier Judiciaire Vierge : </strong>
                    <ul> Tout candidat doit avoir un casier judiciaire vierge de tout délit ou crime. </ul></ul><br>
                    <strong> 📜 Obligations et Règles à Respecter en Carrière </strong><br>
                    Une fois le barreau obtenu, il est impératif de respecter certaines règles pour pouvoir exercer et conserver son titre. <br><br>
                    <ul><strong>🔹 Absence de Casier Judiciaire </strong>
                        <ul> Un avocat ou un procureur ne peut pas avoir de condamnation pour un délit ou un crime.</ul></ul>
                    <ul> <strong>🔹 Interdiction de Participation à des Actes Criminels </strong>
                        <ul> Il est strictement interdit de participer à l'organisation, la planification ou l’exécution d’un délit ou d’un crime. Cependant, il est important de notifier que vous avez le droit d'aider votre client à ne pas se 
                            faire arrêter pour un crime ou un délit qu'il a commis en le conseillant. </ul></ul>
                    <ul> <strong>🔹 Respect de la Confidentialité </strong>
                        <ul> Toutes les informations obtenues dans l'exercice de la profession sont confidentielles et ne doivent jamais être divulguées. </ul></ul>
                    <ul> <strong>🔹 Devoir d’Honnêteté et d’Intégrité </strong>
                        <ul> Chaque avocat et procureur doit agir avec honnêteté, respecter ses engagements et défendre la justice sans abus. </ul></ul>
                    <ul> <strong>🔹 Respect des Tarifs Officiels </strong>
                        <ul> Tous les honoraires et salaires des avocats doivent respecter les grilles tarifaires définies par l'État et le DOJ.</ul></ul>
                    <ul> <strong>🔹 Interdiction de la Discrimination </strong>
                        <ul> Aucune discrimination ne sera tolérée sur la base de la race, du sexe, de l’orientation sexuelle, de la religion ou de tout autre critère protégé. </ul></ul>
                    <ul> <strong>🔹 Obligation de Compétence et de Formation Continue </strong>
                        <ul> Un avocat ou un procureur doit toujours maintenir un niveau de compétence élevé en suivant l’évolution des lois et des procédures.</ul></ul>
                    <ul> <strong>🔹 Éviter les Conflits d’Intérêts </strong>
                        <ul> Il est interdit d’exercer dans une affaire où un conflit d’intérêts existe, sauf avec le consentement éclairé du client. </ul></ul>
                    <ul> <strong>🔹 Diligence et Gestion des Dossiers </strong>
                        <ul> Chaque affaire doit être traitée avec rigueur et sans retard injustifié.</ul></ul>
                    <ul> <strong>🔹 Interdiction d’Abus de Pouvoir </strong>
                        <ul> Aucun avocat ou procureur ne doit exploiter son autorité à des fins personnelles, ni harceler, menacer ou contraindre quelqu’un.</ul></ul>
                    <ul> <strong>🔹 Signalement des Comportements Non Éthiques </strong>
                        <ul> Tout comportement non éthique observé chez un collègue doit être signalé aux autorités compétentes.</ul></ul>
                    <ul> <strong>🔹 Transparence avec les Clients </strong>
                        <ul> Les avocats doivent communiquer clairement avec leurs clients sur leurs droits, options juridiques et frais.</ul></ul>
                    <ul> <strong>🔹 Gestion des Fonds des Clients </strong>
                        <ul> L’argent confié par les clients doit être géré séparément des fonds personnels de l’avocat, avec des registres précis.</ul></ul>
                    <ul> <strong>🔹 Respect des Tribunaux et des Confrères </strong>
                        <ul> Tout avocat ou procureur doit coopérer avec les juges, les autres avocats et le tribunal pour garantir le bon déroulement de la justice.</ul><br>
                    <strong>🚨 Sanctions et Conseil Disciplinaire </strong><br>
                    En cas de non-respect de ces règles, un conseil disciplinaire sera organisé. Un comité d'ethique sera alors créé afin d'enquéter de conseiller la personne 
                    ayant demander la sanction. Seul le Juge de District, le Procueur de District, le Procureur Général et le gouverneur peuvent demander un conseil disciplinaire
                    visant un membre du barreau. Cependant, les responsables de chaque bureau peuvent viré leurs subordoné comme bon leur semble dans les respect des lois de l'Etat.
                    Dans ce cas, la personne licensié garde son barreau et peut retrouver un trvavail dans le monde de la justice. <br><br>
                    <strong>⚠️ Procédure disciplinaire : </strong>
                    <ul> L’avocat ou le procureur sera entendu et pourra se défendre. </ul>
                    <ul> Une sanction sera décidée en fonction de la gravité de la faute. </ul>
                    <ul> La sanction maximale est la radiation du barreau et l'interdiction d'exercer définitivement. </ul><br>
                    <strong>🔥 Conclusion </strong><br>
                    Le respect de ces règles est essentiel pour garantir un système judiciaire impartial et équitable. Tout avocat ou procureur se doit de respecter ses engagements, d’exercer avec intégrité et de défendre les valeurs de la justice.
                </ul>
            </div>

            <div class="card" id="civile">👤Plaintes Civiles
                <ul> 

                </ul>
            </div>

            <div class="card" id="entreprise"> 🏭 Plaintes Entreprises
                <ul> 

                </ul>
            </div>

            <div class="card" id="sp"> 🏥 Plaintes Services Publiques
                <ul> 

                </ul>
            </div>

            <div class="card" id="contrat">📄 Contrats
                <ul> 
                    ???
                </ul>
            </div>

            <div class="card" id="tarif">💸 Grille tarifaires
                <ul> 
                    ???
                </ul>
            </div>

            <div class="card" id="pj">🛡️ Protection Juridique
                <ul> 
                    Le contrat de protection juridique est un accord entre un particulier ou une entreprise et un cabinet d’avocats. Il permet au client de bénéficier d’une assistance juridique continue en échange d’un paiement récurrent.
                    <br><br>
                    📌 À ne pas confondre avec une assurance judiciaire, ce contrat ne couvre pas les frais de procédure, mais garantit un accompagnement et une défense par un cabinet d’avocats en cas de litige.
                    <br><br>
                    <strong>⚖️ Avantages et Fonctionnement du Contrat </strong> <br>
                    <ul> <strong>1️⃣ Pour une Entreprise 🏢 </strong>
                        <ul> ✅ Le cabinet d’avocats représente l’entreprise et ses gérants en cas de litige. </ul>
                        <ul> ❌ Les employés ne sont pas couverts par le contrat. </ul>
                        <ul> 📉 Les frais de protection juridique sont considérés comme des frais d’avocat et sont déductibles des impôts. </ul></ul>
                    <br>
                    <ul> <strong>2️⃣ Pour un Particulier 👤 </strong>
                        <ul> ✅ Le particulier bénéficie d’un accompagnement juridique permanent. </ul>
                        <ul> ❌ Les amis et la famille du client ne sont pas couverts. </ul></ul>
                    <br>
                    <strong>💰 Paiement et Engagements </strong>
                    <ul> 📅 Le client s’engage à payer une somme fixe toutes les semaines pour bénéficier du service. </ul>
                    <ul> ⚖️ Le cabinet s’engage à défendre et conseiller le client en cas de problème avec la justice. </ul>
                    <br>
                    Ce type de contrat est idéal pour ceux qui souhaitent anticiper d’éventuels litiges et bénéficier d’une défense immédiate sans avoir à chercher un avocat en urgence.
                    <br><br>
                    💡 Le contrat de protection juridique est un atout stratégique pour les entreprises et les particuliers souhaitant sécuriser leur avenir juridique avec une assistance professionnelle continue. ⚖️📜
                </ul>
            </div>

            <div class="card" id="barreau">🎓 Examen du barreau
                <ul> 
                    L’examen du barreau est une étape essentielle pour qu’un candidat puisse devenir avocat et exercer légalement. Il permet d’évaluer les connaissances juridiques et les compétences pratiques acquises durant la formation au sein du BAP.
                    <br><br>
                    <strong> 📌 Conditions d’Accès à l’Examen du Barreau</strong><br>
                    Avant de pouvoir passer l’examen, un candidat doit avoir étudié et pratiqué les notions fondamentales du droit à travers :
                    <ul> 📖 Code Pénal → Maîtrise des infractions, des sanctions et des procédures judiciaires. </ul>
                    <ul> 📖 Code Civil → Connaissance des règles régissant les relations entre particuliers. </ul>
                    <ul> ⚖️ Participation aux comparutions → Expérience en défense lors des audiences. </ul>
                    <ul> 🏛️ Participation à un jugement fictif → Mise en situation pratique des rôles d’avocat. </ul>
                    <br>
                    <strong> 🎓 Déroulement de l’Examen du Barreau</strong> <br>
                    <ul> <strong> 1️⃣ 💬 Entretien et Questions de l’Examinateur</strong>
                    <ul> L’examinateur interroge le candidat sur son apprentissage et son expérience au sein du BAP. </ul>
                    <ul> Des questions juridiques précises lui sont posées. </ul>
                    <ul> ⚠️ Les réponses sont définitives → Une fois formulées, il est impossible de revenir dessus. </ul></ul>
                    <br>
                    <ul> <strong> 2️⃣ 🏛️ Mise en Situation : Faux Jugement</strong>
                    <ul> Un jugement fictif est organisé pour tester les compétences pratiques des candidats. </ul>
                    <ul> Les candidats doivent choisir leur rôle (défense ou attaque) via un tirage au sort. </ul>
                    <ul> L’examinateur observe et évalue leur capacité à appliquer leurs connaissances en conditions réelles. </ul>
                    <ul> L’examinateur peut intervenir pour aider, mais son absence d’intervention démontre l’autonomie du candidat. </ul></ul>
                    <br>
                    <strong> 📜 Résultats et Confidentialité</strong>
                    <ul> 📢 Annonce publique des résultats : Une liste officielle des nouveaux avocats sera publiée.</ul>
                    <ul> ❌ Échec : Si un candidat ne figure pas sur la liste, il n’a pas réussi l’examen.</ul>
                    <ul> 🔒 Confidentialité Absolue : Toute fuite d’information sur le déroulement de l’examen est strictement interdite.
                        <ul> Un candidat divulguant des détails sera radié définitivement du barreau.</ul>
                        <ul> Il sera également poursuivi pour non-respect du secret professionnel et interdit à vie d’exercer dans le domaine juridique.</ul></ul>
                    <br>
                    <strong> 💰 Coût de l’Examen</strong> <br>
                    Le passage de l’examen est soumis à des frais d’inscription s’élevant à 15 000$.
                    <br><br>
                    📌 Cet investissement garantit un engagement sérieux des candidats et le respect des procédures officielles.
                    <br><br>
                    <strong> 💡 L’examen du barreau est un test exigeant qui prépare les futurs avocats à la rigueur et aux responsabilités de la profession. Seuls les plus compétents pourront défendre la justice et assurer la protection des droits 
                    de leurs clients. ⚖️🚀</strong>
                </ul>
            </div>

            <div class="card" id="famille">💍 Procédure Familiale
                <ul> 
                    Le Département de la Justice encadre les mariages, divorces et adoptions afin de garantir des procédures claires et légales.<br><br>
                    <strong>💒 Mariage </strong><br>
                    <ul> 🔹 Contrat de mariage obligatoire : Avant de vous marier, vous devez contacter un avocat pour rédiger votre contrat de mariage. Ce contrat définit les engagements des époux. </ul>
                    <ul> 🔹 Cérémonie et officiant : Une fois le contrat signé en présence des témoins et de l'avocat, la cérémonie peut avoir lieu. N’importe qui peut officier un mariage dans l’État de San Andreas. </ul>
                    <ul> 🔹 Changement de nom :
                        <ul> Après la cérémonie, vous devez présenter votre contrat au Gouverneur pour changer votre nom de famille.</ul>
                        <ul> Prenez rendez-vous à l’avance pour éviter une attente inutile.</ul>
                        <ul> Le changement de nom est effectif sous 72h après validation.</ul></ul><br>
                    <strong>⚖️ Divorce </strong><br>
                    Si votre mariage ne fonctionne plus, vous avez la possibilité de demander un divorce.
                    <ul><strong>🔹 Procédure initiale : </strong>
                        <ul>Chaque époux doit être représenté par un avocat distinct (ils peuvent venir du même cabinet pour simplifier la procédure).</ul>
                        <ul>Un dossier expliquant la demande de divorce doit être préparé avec un avocat.</ul></ul>
                    <ul><strong>🔹 Audience privée avec le DOJ : </strong>
                        <ul>Le DOJ organise une audience privée pour tenter un accord à l’amiable.</ul>
                        <ul>Si aucun accord n'est trouvé, une date pour un jugement civil devant un juge sera fixée.</ul></ul>
                    <ul><strong>🔹 Jugement du divorce : </strong>
                        <ul>Le juge examine les dossiers et prend une décision finale.</ul>
                        <ul>Si le divorce est prononcé, un document officiel signé par le juge sera remis aux ex-conjoints.</ul></ul>
                    <ul><strong>🔹 Changement de nom post-divorce : </strong>
                        <ul>Vous pourrez présenter ce document au Gouverneur afin de récupérer votre nom de naissance.</ul>
                        <ul>Le changement est effectif sous 72h après validation.</ul></ul><br>
                    <strong>👶 Adoption d’un Mineur (Inférieur à 21 ans) </strong><br>
                    L’adoption d’un mineur est une démarche sérieuse impliquant plusieurs conditions strictes.<br>
                    <ul> <strong>🔹 Critères obligatoires : </strong>
                        <ul> ✔ L’adopté doit être mineur (Inférieur à 21 ans). </ul>
                        <ul> ✔ L’adoptant doit être âgé d’au moins 25 ans dans l’année civile. </ul>
                        <ul> ✔ Stabilité financière : Un emploi stable depuis au moins 3 semaines est requis. </ul>
                        <ul> ✔ Logement : L’adoptant doit posséder un logement à son nom depuis au moins 1 semaine. </ul>
                        <ul> ✔ Examen médical de l’adopté (payé par l’adoptant). </ul>
                        <ul> ✔ Évaluation psychologique de l’adoptant (payé par l’adoptant). </ul>
                        <ul> ✔ Casier judiciaire vierge de tout crime ou délit majeur pour l’adoptant. </ul>
                        <ul> ✔ L’adopté peut avoir un casier judiciaire avec des délits/crimes, mais le SASP effectuera des inspections régulières. </ul></ul><br>
                    <ul> <strong>🔹 Procédure d’adoption : </strong>
                        <ul> 1️⃣ Prendre contact avec un avocat qui vérifiera si vous remplissez toutes les conditions.</ul>
                        <ul> 2️⃣ Préparer un dossier de tutelle avec l’avocat.</ul>
                        <ul> 3️⃣ Audience avec un juge pour valider l’adoption.</ul>
                        <ul> 4️⃣ Obtention d’un contrat de tutelle signé par le juge.</ul></ul><br>
                    📌 Une fois adopté, l’adoptant devient responsable du bien-être et de l’éducation du mineur jusqu’à sa majorité.<br><br>
                    <strong>🏡 Adoption d’un Majeur (≥21 ans) </strong>
                    L’adoption d’un majeur suit un cadre légal différent.
                    <ul> <strong>🔹 Critères obligatoires : </strong>
                        <ul> ✔ L’adopté doit être majeur (≥21 ans).</ul>
                        <ul> ✔ Une différence d’âge d’au moins 4 ans entre l’adopté et l’adoptant.</ul>
                        <ul> ✔ Casier judiciaire vierge de tout crime ou délit majeur pour l’adoptant.</ul>
                        <ul> ✔ Un couple marié souhaitant adopter est préférable.</ul></ul><br>
                    <ul> <strong>🔹 Procédure d’adoption : </strong>
                        <ul> 1️⃣ Contacter un avocat pour vérifier que vous remplissez toutes les conditions.</ul>
                        <ul> 2️⃣ Préparer un dossier d’adoption avec l’avocat.</ul>
                        <ul> 3️⃣ Audience avec un juge pour valider l’adoption.</ul>
                        <ul> 4️⃣ Obtention d’un contrat d’adoption signé par le juge.</ul></ul><br>
                    📌 L’adopté peut ensuite demander un changement de nom en présentant le contrat au Gouverneur.<br><br>
                    <strong>📝 Informations Complémentaires </strong>
                    <ul> ✅ L’adoption crée une responsabilité légale pour l’adoptant, qui devient garant du bien-être de l’adopté. </ul>
                    <ul> ✅ Toute adoption doit être validée par le DOJ et signée par un juge. </ul>
                    <ul> ✅ Le changement de nom post-adoption prend 72h après validation par le Gouverneur. </ul><br>
                    📌 Le mariage, le divorce et l’adoption sont encadrés par le Département de la Justice et doivent être effectués en toute légalité.
                </ul>
            </div>

            <div class="card" id="compa">⏳ Comparutions immédiates
                <ul> 
                    Lorsqu’une personne est arrêtée, elle dispose du droit fondamental de demander un avocat. Si elle n’en possède pas un, elle peut se voir attribuer un avocat commis d’office du Bureau des Avocats Pénalistes (BAP).
                    <br><br>
                    Dans le cas d’un crime ou d’un délit majeur, le SASP a l’obligation de faire appel au Département de la Justice (DOJ), incluant un Procureur et un Juge, pour garantir une procédure judiciaire conforme.
                    <br><br>
                    <strong>📌 Délais et Organisation de la Comparution</strong>
                    <br><br>
                    <strong>✅ Délais d’attente avant la poursuite de la procédure</strong><br>
                    Avocats, Procureurs et Juges disposent de 10 minutes répondre à la demande du SASP.
                    <br>
                    Après ce délai :
                    <ul>Si aucun avocat n’est disponible → La procédure se poursuit sans avocat. </ul>
                    <ul>Si aucun Procureur n’est disponible → L’individu peut être placé sous bracelet électronique ou mis en cellule pour une durée maximale de 24 heures en attendant un procureur. </ul>
                    <ul> Si aucun Juge n’est disponible → Le Procureur endosse temporairement son rôle et prend la décision finale. </ul>
                    <br><br>
                    <strong>⚖️ Déroulement d’une Comparution</strong><br><nr>
                    <ul> <strong>1️⃣ Présentation des faits</strong>
                        <ul> Les agents du SASP exposent les faits aux parties présentes (Avocat & Procureur). </ul></ul>
                    <br>
                    <ul> <strong>2️⃣ Consultation avocat-client</strong>
                        <ul> L’avocat dispose de 5 minutes pour discuter en privé avec son client. </ul></ul>
                    <br>
                    <ul> <strong>3️⃣ Interrogatoire</strong>
                        <ul> Le Procureur et le SASP procèdent à l’interrogatoire de l’accusé en présence de son avocat. </ul></ul>
                    <br>
                    <ul> <strong> 4️⃣ Intervention du Juge</strong>
                        <ul> Une fois l’interrogatoire terminé, le Juge est invité à entrer et à écouter les parties. </ul></ul>
                    <br>
                    <ul> <strong>5️⃣ Requêtes et Plaidoiries</strong>
                        <ul> Le Procureur propose une peine et apporte ses justifications.</ul>
                        <ul> L’Avocat plaide en faveur de son client et peut proposer une alternative ou une réduction de peine. </ul></ul>
                    <br>
                    <ul> <strong>6️⃣ Décision finale du Juge</strong>
                        <ul> Après avoir entendu les arguments, le Juge rend sa décision. </ul>
                        <ul> Les agents du SASP appliquent la sentence et finalisent le Rapport d’Arrestation. </ul></ul>
                    <br>
                    <strong>🚨 Procédure en Cas d’Aveu</strong>
                    <ul> Si un individu avoue un crime ou un délit, un jugement n’est pas nécessaire.</ul>
                    <ul>Le Procureur peut alors directement appliquer une peine, conformément aux textes en vigueur.</ul>
                    <br>
                    <strong>📢 Conclusion</strong><br>
                    Le processus d’arrestation et de comparution suit un cadre strict afin d’assurer une justice équitable et efficace.
                    <ul> 🔹 Les droits de l’accusé sont protégés, avec la possibilité d’être assisté d’un avocat. </ul>
                    <ul> 🔹 Le SASP doit systématiquement impliquer le DOJ en cas de crime ou de délit majeur. </ul>
                    <ul> 🔹 Les délais d’attente permettent de garantir un procès équitable, tout en assurant la fluidité du système judiciaire. </ul>
                    <ul> 🔹 Les aveux permettent de raccourcir la procédure en évitant un jugement. </ul>
                    <br>
                    <strong>💡 Cette procédure garantit une justice rapide, efficace et respectueuse des droits des citoyens.</strong>
                </ul>
            </div>

            <div class="card" id="jugement"> 👨‍⚖️ Jugement
                <ul> 
 
                </ul>
            </div>

            <div class="card" id="juge">⚖️ Déroulement d'un jugement
                <ul> 
                    Les jugements sont des procédures publiques encadrées par des règles strictes garantissant l’équité et le respect des droits de chacun.
                    <br><br>
                    <strong> 🕘 Horaires et Organisation des Jugements </strong>
                    <ul> 🔹 Début des jugements : 21h45 précises. </ul>
                    <ul> 🔹 Multiples affaires : Si plusieurs jugements sont programmés, ils se dérouleront les uns à la suite des autres à partir de cette heure.</ul>
                    <ul> 🔹 Transport des accusés :
                        <ul> Prisonniers : Transportés du centre pénitentiaire vers le DOJ par le SASP, le SOB ou les US Marshals.</ul>
                        <ul> Sous bracelet électronique : L’accusé doit se rendre par lui-même au DOJ pour assister à son jugement.</ul></ul>
                    <ul> 🔹 Accès au public :
                        <ul> Tous les jugements sont ouverts au public, sauf cas exceptionnels où le juge peut décider d’une audience à huis clos.</ul>
                        <ul> Le juge choisit si la salle reste ouverte pendant l’audience.</ul></ul>
                    <ul> 🔹 Témoins :
                        <ul> Doivent être prévenus à l’avance.</ul>
                        <ul> Présence obligatoire dans la salle au moment du jugement.</ul></ul><br>
                    <strong> ⚖️ Déroulement d'un Jugement </strong><br><br>
                    <ul> <strong> 1️⃣ Arrivée de l’accusé et discussion avec l’avocat </strong>
                        <ul> 🔹 L’accusé dispose de quelques minutes pour s’entretenir avec son avocat.</ul>
                        <ul> 🔹 L’accusé et son avocat prennent ensuite place à leur bureau.</ul>
                        <ul> 🔹 L’accusation se positionne au bureau opposé.</ul></ul><br>
                    <ul> <strong> 2️⃣ Entrée du juge et ouverture de l’audience </strong>
                        <ul> 🔹 Tous les participants se lèvent à l’entrée du juge.</ul>
                        <ul> 🔹 Le juge donne l’ordre de s’asseoir et ouvre officiellement l’audience.</ul></ul><br>
                    <ul> <strong> 3️⃣ Lecture des faits et plaidoyer de l’accusé </strong>
                        <ul> 🔹 Le juge énonce les faits reprochés à l’accusé.</ul>
                        <ul> 🔹 Il demande ensuite à l’accusé s’il plaide coupable ou non coupable.</ul></ul><br>
                    <ul> <strong> 4️⃣ Réquisitions initiales (Plaidoirie initiale) </strong>
                        <ul> 🔹 L’accusation présente ses arguments sans interruption.</ul>
                        <ul> 🔹 La défense répond ensuite avec sa propre plaidoirie sans être interrompue.</ul>
                        <ul> 🔹 Après ces réquisitions initiales, chaque partie peut réagir à celle de l’autre.</ul></ul><br>
                    <ul> <strong> 5️⃣ Présentation des preuves </strong>
                        <ul> 🔹 L’accusation présente d’abord ses preuves.</ul>
                        <ul> 🔹 La défense peut objecter en justifiant ses objections auprès du juge.</ul>
                        <ul> 🔹 Le juge décide d’accepter ou de rejeter les objections.</ul>
                        <ul> 🔹 Une fois la présentation des preuves de l’accusation terminée, c’est au tour de la défense de présenter les siennes.</ul>
                        <ul> 🔹 L’accusation peut alors objecter aux éléments apportés par la défense.</ul></ul><br>
                    <ul> <strong> 6️⃣ Témoignages et interrogatoires </strong>
                        <ul> 🔹 Les témoins sont placés sous serment.</ul>
                        <ul> 🔹 Ils sont interrogés en premier par la partie qui les a appelés.</ul>
                        <ul> 🔹 La partie adverse peut ensuite procéder à un contre-interrogatoire.</ul>
                        <ul> 🔹 Il est possible de faire des objections sur les questions posées.</ul></ul><br>
                    <ul> <strong> 7️⃣ Réquisitions finales (Plaidoirie finale) </strong>
                        <ul> 🔹 L’accusation présente son réquisitoire final, sans interruption.</ul>
                        <ul> 🔹 La défense présente ensuite son dernier plaidoyer, sans interruption.</ul></ul><br>
                    <ul> <strong> 8️⃣ Délibération et verdict </strong>
                        <ul> 🔹 Le juge peut rendre son verdict immédiatement.</ul>
                        <ul> 🔹 Il peut aussi prendre du temps pour réétudier le dossier quelque minutes avant de donner sa décision.</ul></ul><br>
                    <strong> 📝 Informations Complémentaires </strong>
                    <ul> ✅ Les jugements sont encadrés par la loi et doivent respecter un processus strict.</ul>
                    <ul> ✅ Le respect des règles de procédure est essentiel pour garantir un jugement équitable.</ul>
                    <ul> ✅ Les objections doivent être justifiées et validées par le juge.</ul><br>

                    📌 Toute personne impliquée dans un jugement doit être préparée et respecter l’autorité du tribunal.
                </ul>
            </div>

            <div class="card" id="patriot"> U.S. Patriot Act
                <ul> 
                    Adoptée en 2001 à la suite des attentats du 11 septembre, la loi USA PATRIOT Act (Uniting and Strengthening America by Providing Appropriate Tools Required to Intercept and Obstruct Terrorism) est une législation fédérale américaine 
                    permettant aux autorités d’adopter des mesures exceptionnelles pour lutter contre les menaces terroristes et les activités criminelles transnationales.
                    <br><br>
                    Cette loi confère aux forces de l’ordre et aux agences de renseignement des pouvoirs renforcés pour prévenir et neutraliser les menaces terroristes, souvent au détriment des libertés civiles.
                    <br><br>
                    <strong>📌 Effets et Pouvoirs Accordés par le PATRIOT Act</strong> <br><br>
                    <strong>✅ Surveillance renforcée des communications</strong>
                    <ul> Autorisation d’intercepter et de surveiller les communications téléphoniques, électroniques et bancaires des individus suspects. </ul>
                    <ul> Mise en place de mandats de perquisition secrets et rapides, permettant d’accéder aux données personnelles sans avertir la cible. </ul>
                    <br>
                    <strong>✅ Gel et saisie des actifs financiers</strong>
                    <ul> Les autorités peuvent bloquer ou saisir les fonds appartenant à des individus ou organisations liés au terrorisme. </ul>
                    <ul> Suivi des transactions bancaires internationales pour détecter les financements illicites. </ul>
                    <br>
                    <strong>✅ Arrestations et détentions prolongées sans inculpation</strong>
                    <ul> Toute personne soupçonnée de terrorisme peut être arrêtée et détenue sans charges officielles pendant une durée prolongée. </ul>
                    <ul> Les non-citoyens peuvent être détenus indéfiniment s’ils sont considérés comme une menace pour la sécurité nationale. </ul>
                    <ul> Si les forces de l'ordres réunissent suffisamnent de preuves, le bureau du procureur peut demander l'envoie immédiat de la personne concerné en prison fédérale contre le terrorisme, dans cette prison, l'accusé sera intérogé puis,
                    si il ne présente plus aucune menace, sera libéré. </ul>
                    <br>
                    <strong>✅ Coopération renforcée entre les agences de renseignement et la police</strong>
                    <ul> L'ensembles des polices féderale et etatique peuvent échanger des informations librement pour mieux surveiller les réseaux terroristes. </ul>
                    <ul> Suppression des restrictions limitant le partage d’informations entre agences. </ul>
                    <br>
                    <strong>✅ Expulsions et restrictions pour les étrangers</strong>
                    <ul> Un individu étranger suspecté de soutenir une organisation terroriste peut être expulsé immédiatement sans passer par une procédure judiciaire classique. </ul>
                    <ul> Augmentation des contrôles et restrictions pour l’immigration et l’obtention de visas. </ul>
                    <br>
                    <strong>⚠️ Critères pour l’Application du PATRIOT Act</strong><br>
                    L’application du PATRIOT Act nécessite des preuves établissant qu’un individu ou un groupe est impliqué dans des activités terroristes ou criminelles graves.
                    <br><br>
                    <ul> 1️⃣ Lien avéré avec une organisation terroriste 
                        <ul> Appartenance ou soutien à un groupe reconnu comme organisation terroriste par les États-Unis. </ul></ul>
                    <ul> 2️⃣ Menace directe à la sécurité nationale
                        <ul> Participation à des activités mettant en danger la population ou les infrastructures critiques (ex. attentats, cyberattaques, sabotage).</ul></ul>
                    <ul> 3️⃣ Activités criminelles suspectes ou financement du terrorisme
                        <ul> Transferts d’argent suspects, blanchiment de fonds ou financement d’attaques terroristes.</ul>
                        <ul> Communication avec des groupes terroristes internationaux.</ul></ul>
                    <br>
                    <strong>📢 Conclusion</strong><br>
                    L’USA PATRIOT Act est un outil puissant utilisé par les autorités américaines pour traquer, neutraliser et prévenir les menaces terroristes. Cependant, son application pose des questions éthiques et juridiques, notamment sur le respect 
                    des droits fondamentaux et de la vie privée.
                    <br><br>
                    Malgré les critiques, cette loi reste l’un des principaux cadres législatifs pour la sécurité nationale aux États-Unis. Elle continue d’être appliquée pour lutter contre le terrorisme international, tout en soulevant un débat permanent 
                    entre sécurité et libertés individuelles.
                    <br><br>
                    Il est donc du devoir du DOJ et du Bureau du Procureur de bien utiliser cette loi afin de garantir la sécurité au sein de l'Etat tout en conservant un respect permanent des droits de ces citoyens.
                </ul>
            </div>

            <div class="card" id="rico"> 🚔 Loi R.I.C.O.
                <ul> 
                    La Loi RICO (Racketeer Influenced and Corrupt Organizations Act) est une loi fédérale adoptée en 1970, permettant l’arrestation et le démantèlement de groupes criminels organisés représentant une menace directe pour la sécurité de 
                    l’État de San Andreas.
                    <br>
                    Elle peut être déclenchée uniquement par le Procureur Général ou le Procureur de District, et confère des pouvoirs exceptionnels aux forces de l’ordre pour neutraliser une organisation criminelle sans mandat ni procédure judiciaire préalable.
                    <br><br>
                    <strong>📌 Effets de la Loi RICO</strong>
                    <ul> ✅ Arrestation immédiate de tous les membres du groupe ciblé ainsi que leurs complices. </ul>
                    <ul> ✅ Perquisitions immédiates des biens et propriétés sans mandat. </ul>
                    <ul> ✅ Incarcération en prison fédérale de toutes les personnes arrêtées dans l'attente de leur jugement</ul>
                    <ul> ✅ Usage renforcé de la force autorisé pour les forces de l’ordre lors des interventions contre le groupe visé. </ul>
                    <br>
                    <strong>⚠️ Conditions Obligatoires pour Déclarer la Loi RICO</strong><br>
                    L’application de la Loi RICO est une mesure extrême qui ne peut être utilisée qu’en respectant trois conditions majeures :
                        <ul> 1️⃣ Preuve d’une activité criminelle prolongée
                            <ul> Le groupe ou l’individu doit être impliqué dans des activités criminelles depuis au moins un mois.</ul></ul>
                        <ul> 2️⃣ Preuve d’une menace directe pour la sécurité de l’État
                            <ul> Le groupe ou l’individu doit constituer un danger immédiat et sérieux pour l’ordre public et la sécurité de San Andreas.</ul></ul>
                        <ul> 3️⃣ Attaque avérée contre une institution ou une figure d’autorité
                            <ul>La cible doit avoir mené une attaque directe contre l’un des lieux ou personnes suivants :
                                <ul> 🔹 Institutions gouvernementales (Gouvernement, Palais de Justice, Poste de Police, Hôpital). </ul>
                                <ul> 🔹 Hautes autorités (Chief of Police, Procureur, Procureur de District, Procureur Général, Gouverneur, Lieutenant-Gouverneur). </ul> </ul> </ul>
                        <br>
                    <strong>📢 Conclusion</strong><br>
                    La Loi RICO est une mesure judiciaire exceptionnelle réservée aux situations où un groupe criminel organisé représente une menace immédiate pour l’État. Son activation doit être justifiée par des preuves solides et irréfutables.
                    <br>
                    Son application entraîne des arrestations et perquisitions immédiates, sans mandat, ainsi qu’une incarcération immédiate en prison fédérale dans l'attente d'un jugement. C’est un outil puissant du système judiciaire pour lutter contre 
                    les organisations criminelles les plus dangereuses.
                </ul>
            </div>

            <div class="card" id="doc"> 📜 Documents Officiels du Département de la Justice (DOJ)
                <ul>             
                    Le Département de la Justice de San Andreas (DOJ) a la capacité de rédiger plusieurs types de documents officiels permettant d’encadrer et de réglementer les actions judiciaires et policières. Parmi ces documents, 
                    les mandats sont les plus courants, servant à accorder certaines autorisations spécifiques aux forces de l’ordre.
                    <br><br>
                    Les mandats sont délivrés par le DOJ à la demande du San Andreas State Police (SASP) ou de l’Internal Revenue Service (IRS). Ils permettent aux forces de l’ordre d’agir dans un cadre légal précis.
                    <br><br>
                    <strong>🔹 Mandat d’Arrêt </strong>
                    <ul> 📍Permet à la police d’arrêter un individu sans flagrant délit. </ul>
                    <ul> 📍Nécessite la présentation de preuves solides justifiant l’arrestation, sans pour autant nécessiter un dossier de condamnation. </ul>
                    <ul> 📍Confidentiel : il ne doit pas être rendu public mais peut être montré à la cible ou à son avocat sur demande. </ul>
                    <br>
                    <strong>🔹 Mandat de Perquisition de Lieu </strong>
                    <ul> 📍Délivré lorsque un lieu est suspecté d’être utilisé à des fins illégales. </ul>
                    <ul> 📍Permet uniquement de récupérer le nom du propriétaire auprès de l’agence immobilière et de perquisitioner la propriété ou la position concernée</ul>
                    <br>
                    <strong>🔹 Mandat de Perquisition </strong>
                    <ul> 📍Autorise la perquisition des biens d’un individu ou d’un groupe. </ul>
                    <ul> 📍Doit préciser avec exactitude les biens concernés et ceux qui ne doivent pas être perquisitionnés. </ul>
                    <ul> 📍Confidentiel : présenté uniquement lors de la perquisition ou sur demande de la cible ou de son avocat. </ul>
                    <br>
                    <strong>🔹 Mandat de Fermeture Administrative </strong>
                    <ul> 📍Utilisé principalement par l’IRS, il ordonne la fermeture temporaire ou définitive d’une entreprise. </ul>
                    <ul> 📍Confidentiel : remis uniquement au propriétaire de l’entreprise et à ses avocats sur demande. </ul>
                    <br>
                    <strong>⚠️ Conditions d’Obtention d’un Mandat </strong>
                    <ul> 📍Tous les mandats sont délivrés par le Bureau du Procureur.</ul> 
                    <ul> 📍Un dossier complet n’est pas obligatoire : un rapport d’opération peut suffire.</ul> 
                    <ul> 📍Le procureur doit garantir son impartialité et vérifier l’origine des informations.</ul>
                    <ul> 📍Des simples suspicions ne suffisent pas pour l’émission d’un mandat, mais quelques preuves concrètes peuvent être suffisantes. </ul>
                    <ul> 📍Un mandat ne signifie pas une condamnation : il s’agit d’un outil d’enquête, pas d’un jugement définitif. </ul>
                    <br>
                    <strong>🔹 Cas spécifique : </strong> <br>
                    Si un individu commet trois délits majeurs, peu importe leur nature, un mandat de perquisition sur ses propriétés sera automatiquement émis.
                    <br><br>
                    <strong>🚨 Avis de Recherche </strong><br>
                    Un Avis de Recherche est un document officiel permettant de signaler un individu dangereux au public et d’offrir une récompense à toute personne fournissant des informations utiles à son arrestation.
                    <br><br>
                    <strong>📌 Caractéristiques de l’Avis de Recherche : </strong>
                    <ul> 📍Il est publié officiellement par le DOJ sous forme d’annonce publique. </ul>
                    <ul> 📍L’individu doit être en cavale. </ul>
                    <ul> 📍Un Mandat d’Arrêt doit être déjà actif contre lui. </ul>

                    📌 Distinction entre mandat d'arrêt et avis de recherche:
                    <ul> 📍Un Mandat d’Arrêt peut exister sans Avis de Recherche. </ul>
                    <ul> 📍Un Avis de Recherche implique obligatoirement un Mandat d’Arrêt. </ul>
                    <br>
                    <strong> 📌 Conclusion </strong> <br>
                    Les documents officiels du DOJ jouent un rôle essentiel dans la gestion judiciaire et sécuritaire de San Andreas. Les mandats permettent d’encadrer les actions des forces de l’ordre, tandis que les avis de recherche permettent d’alerter la population et de faciliter l’arrestation d’individus dangereux.
                    <br><br>
                    Le DOJ veille à l’équilibre entre l’efficacité des enquêtes et le respect des droits des citoyens, garantissant une justice impartiale et transparente.
                </ul>
            </div>

            <div class="card" id="peter"> 🔍 Perquisitions
                <ul> 
                    Les perquisitions sont des procédures judiciaires permettant aux forces de l’ordre d’inspecter et de saisir des biens appartenant à une personne suspectée d’activités illégales. Elles sont menées uniquement sur mandat délivré par une 
                    autorité compétente et concernent plusieurs types de biens.
                    <br><br>
                    <strong> 🔹 📁 Dossier Médical </strong>
                    <ul> 📌Les dossiers médicaux de la cible peuvent être consultés à l’hôpital et des copies peuvent être réalisées.</ul>
                    <ul> 📌Les originaux ne sont jamais saisis par le SASP afin de garantir un suivi médical correct.</ul>
                    <br>
                    <strong> 🔹 📱 Téléphone avec Carte SIM </strong>
                    <ul> 📌Tous les téléphones et cartes SIM de la cible peuvent être saisis et inspectés. </ul>
                    <ul> 📌Des copies des données retrouvées peuvent être effectuées. </ul>
                    <ul> 📌Le téléphone doit être rendu à la fin de l’enquête ou lorsque le mandat expire. </ul>
                    <ul> 📌Obligation de fournir le code de déverrouillage : En cas de refus, des experts habilités procèderont au piratage du téléphone, qui ne sera alors pas restitué. </ul>
                    <br>
                    <strong> 🔹 🏠 Propriétés Immobilières </strong>
                    <ul> 📌L’agence immobilière devra fournir la liste complète des biens appartenant à la cible. </ul>
                    <ul> 📌Les propriétés seront fouillées, avec ou sans la présence du propriétaire. </ul>
                    <ul> 📌Tous les objets détenus illégalement seront saisis et ne seront pas restitués. </ul>
                    <ul> 📌En cas de saisie d’une forte somme d’argent en liquide, un justificatif devra être fourni pour récupérer les fonds. </ul>
                    <ul> 📌Aucun dédommagement ne sera accordé en cas de dégâts causés par les forces de l’ordre. </ul>
                    <ul> 📌Si le juge ordonne la saisie définitive d’un bien immobilier, les serrures seront changées et le propriétaire n’aura plus accès à la propriété. </ul>
                    <br>
                    <strong> 🔹 🚗 Véhicules </strong>
                    <ul> 📌Tous les véhicules appartenant à la cible seront fouillés et stockés par le SASP jusqu’à la fin de l’enquête. </ul>
                    <ul> 📌À la fin du jugement :
                        <ul> - Le véhicule est restitué ou confisqué définitivement en fonction de la décision judiciaire.</ul>
                    </ul>
                    <ul> 📌Conditions de restitution :
                        <ul> - Seul un juge ou un accord officiel peut empêcher la restitution. </ul>
                        <ul> - Le propriétaire devra présenter la carte grise de chaque véhicule pour le récupérer. </ul>
                    </ul>
                    <ul> 📌Cas spécifique des véhicules liés à des actes criminels :
                        <ul> - Un véhicule retrouvé à plusieurs reprises (minimum 4 fois) sur les lieux d’actes illégaux (braquages, prises d’otages, etc.) pourra être perquisitionné par le SASP.</ul> 
                        <ul> - Un mandat de perquisition devra être obtenu auprès des procureurs. </ul>
                        <ul> - Le propriétaire devra se rendre au poste de police pour justifier l’utilisation du véhicule. </ul>
                        <ul> - Délai de réclamation : 1 semaine après la perquisition. </ul>
                        <ul> - Si aucune réclamation n’est effectuée, le véhicule sera envoyé à la casse et détruit. </ul>
                    </ul><br>
                    <strong> 🔹 🏦 Comptes Bancaires </strong>
                    <ul> 📌Les comptes bancaires de la cible peuvent être gelés et inspectés jusqu’à la fin de l’enquête. </ul>
                    <ul> 📌Si le juge ordonne la saisie du compte, celui-ci sera vidé avant d’être rouvert. </ul>
                    <ul> 📌Si aucune infraction n’est prouvée, le compte sera restauré dans son état initial. </ul>
                    <br>
                    <strong> ⚠️ Conclusion </strong>
                    Les perquisitions sont des outils essentiels pour lutter contre la criminalité et rassembler des preuves dans le cadre d’enquêtes judiciaires. Toute obstruction à une perquisition peut entraîner des sanctions sévères.
                    
                    Toute personne concernée par une perquisition est tenue de coopérer pleinement avec les forces de l’ordre.
                </ul>
            </div>

            <div class="card" id="peine">⚔️ Système des Peines : Minimale, Nominale et Maximale
                <ul> 
                    Le Système Judiciaire de l’État de San Andreas applique trois niveaux de peines pour garantir une justice adaptée aux circonstances et aux antécédents des accusés.
                    <br><br>
                    <strong> 📌 Les Trois Types de Peines </strong>
                    <ul> 🔹 Minimale : Représente 75% de la peine prévue par le Code Pénal. </ul>
                    <ul> 🔹 Nominale : Représente 100% de la peine prévue par le Code Pénal. (Peine appliquée par défaut) </ul>
                    <ul> 🔹 Maximale : Représente 150% de la peine prévue par le Code Pénal. </ul>
                    <br>
                    Par défaut, toute infraction (contravention, délit mineur, délit majeur ou crime) est sanctionnée par la peine nominale. Toutefois, en fonction des circonstances, la peine peut être réduite (minimale) ou augmentée (maximale).
                    <br><br>
                    <strong> ⚖️ 📉 Circonstances Atténuantes (Diminution de Peine) </strong><br>
                    Un juge ou un procureur peut décider d’appliquer une peine minimale si l’accusé présente des éléments justifiant une certaine clémence. Parmi les facteurs pouvant influencer cette décision :
                    <ul> ✔ Histoire cohérente d’embrigadement (l’accusé a été manipulé ou forcé). </ul>
                    <ul> ✔ Bénéfice du doute en l’absence de casier judiciaire. </ul>
                    <ul> ✔ Indulgence du SASP/DOJ en fonction du contexte de l’infraction. </ul>
                    <ul> ✔ Grande coopération lors de l’arrestation et de la procédure judiciaire. </ul>
                    <br>
                    <strong> ⚖️ 📈 Circonstances Aggravantes (Augmentation de Peine) </strong>
                    À l’inverse, certains comportements ou antécédents peuvent entraîner une peine maximale pour sanctionner une attitude répréhensible ou une récidive :
                    <ul> ❌ Révolte ou trouble lors de la procédure judiciaire. </ul>
                    <ul> ❌ Insultes répétées envers les forces de l’ordre ou la justice. </ul>
                    <ul> ❌ Récidive d’un fait similaire. </ul>
                    <ul> ❌ Casier judiciaire contenant plus de 5 infractions. </ul>
                    <ul> ❌ Manque important de coopération lors de l’arrestation. </ul>
                    <br>
                    <strong> 🔍 Réduction de Peine en Échange d’Informations </strong>
                    Dans certains cas, une réduction de peine peut être accordée en échange d’informations utiles aux enquêteurs ou aux procureurs.
                    <ul> ✅ Si l’accusé encourt une peine maximale, il peut demander un interrogatoire. Si les informations fournies sont jugées cohérentes et concrètes, la peine peut être abaissée à une peine nominale. </ul>
                    <ul> ✅ Si un procureur ou un agent s’engage à réduire une peine ou une amende en échange d’informations, il est tenu de respecter sa parole. </ul>
                    <br>
                    ⚠ Attention : Seules des informations fiables et vérifiables permettent d’obtenir une réduction. Toute tentative de manipulation ou d’informations fausses peut être sanctionnée.
                    <br><br>
                    <strong> 🚨 Récidive et Sanction Automatique </strong> <br>
                    Si un délit majeur ou un crime est inscrit trois fois sur le casier judiciaire d’un individu, la peine maximale devient automatiquement obligatoire. Elle ne pourra être réduite qu’en échange d’informations valables.
                    <br><br>
                    <strong>📌 Conclusion : </strong> <br>
                    
                    Le système de peines de San Andreas vise à garantir une justice équilibrée, en prenant en compte à la fois la gravité de l’infraction et le comportement de l’accusé. Il permet d’adapter les sanctions tout en 
                    préservant la sécurité et l’ordre public.
                </ul>
            </div>

            <div class="card" id="code"> 🟢🟠🔴⚫ Les Codes d'État de San Andreas
                <ul>               
                    L’État de San Andreas dispose de quatre codes d’état distincts, chacun définissant un niveau de vigilance et des mesures spécifiques adaptées aux circonstances. Ces codes peuvent être appliqués à l’ensemble de l’État, à une ville spécifique, 
                    ou à un quartier déterminé, en fonction de la situation.
                    <br><br>
                    <strong> L’application d’un code peut être décidée par : </strong>
                    <ul> ✔ Le Département de la Justice (DOJ) </ul>
                    <ul> ✔ L’État-Major du SASP (San Andreas State Police) </ul>
                    <ul> ✔ Le Gouverneur de l’État </ul>
                    <br>
                    <strong>🟢 Code Vert – Normalité et Respect des Lois </strong> <br>
                    Le Code Vert représente la situation normale de l’État.
                    <ul>✔ Il est toujours actif par défaut, sauf si un autre code est déclaré. </ul>
                    <ul>✔ Le Code Pénal s’applique intégralement et doit être respecté par toute la population, y compris le SASP. </ul>
                    <ul>✔ Aucun renforcement particulier des mesures de sécurité n’est en vigueur. </ul>
                    <br>
                    <strong>🟠 Code Orange – Vigilance Renforcée </strong> <br>
                    Le Code Orange est activé en cas de menace accrue ou de situation à risque nécessitant une surveillance plus stricte.
                    <ul> ✔ Les forces de l’ordre doivent être plus vigilantes et attentives aux comportements suspects. </ul>
                    <ul> ✔ Le SASP est autorisé à effectuer des fouilles sur une personne ou un véhicule s’il existe un soupçon légitime d’activité illégale. </ul>
                    <ul> ✔ Les citoyens doivent coopérer davantage avec les forces de l’ordre. </ul>
                    <br>
                    <strong>🔴 Code Rouge – Menace Élevée </strong> <br>
                    Le Code Rouge est déclenché lors de situations extrêmement dangereuses, comme des attaques organisées ou des insurrections.
                    <ul> ✔ Le SASP peut utiliser un équipement avancé pour faire face aux menaces. </ul>
                    <ul> ✔ Les forces de l’ordre peuvent fouiller librement toute personne, tout véhicule ou tout bien sans justification préalable. </ul>
                    <ul> ✔ Les règles d’engagement sont modifiées :
                        <ul> 🔹Tout individu armé peut être neutralisé sans sommation.</ul>
                        <ul> 🔹Les interventions des forces de l’ordre sont immédiates et musclées pour protéger la population.</ul>
                    </ul>
                    <br>
                    <strong>⚫ Code Noir – Situation de Crise Majeure </strong> <br>
                    Le Code Noir est le niveau d’alerte maximal appliqué uniquement en cas de guerre urbaine, d’attaque terroriste, ou de catastrophe majeure.
                    <ul> ✔ Le SASP a un accès total à l’équipement militaire et tactique. </ul>
                    <ul> ✔ Les fouilles sont généralisées : les forces de l’ordre peuvent contrôler toute personne, tout véhicule et toute propriété sans restriction. </ul>
                    <ul> ✔ Les règles d’engagement sont extrêmes :
                        <ul> 🔹Tout individu armé peut être abattu sans sommation.</ul>
                        <ul> 🔹Aucune négociation n’est possible face à la menace.</ul>
                    </ul>
                    <ul> ✔ Un confinement général est ordonné :
                        <ul> 🔹Toute personne trouvée hors de son domicile est considérée comme coupable de rébellion.</ul>
                        <ul> 🔹Les forces de l’ordre sont habilitées à procéder à des arrestations massives pour garantir la sécurité.</ul>
                    </ul>
                    <br>
                    <strong>📌 Conclusion </strong>
                    Le système des Codes d’État de San Andreas permet d’adapter rapidement les mesures de sécurité en fonction du niveau de menace. Chaque citoyen doit se tenir informé de l’état d’alerte en vigueur et respecter scrupuleusement les consignes des autorités compétentes.
                    <br><br>
                    <strong>Le non-respect des mesures instaurées par un Code Orange, Rouge ou Noir peut entraîner des sanctions judiciaires sévères.</strong>
                </ul>
            </div>

        </div>
    </div>

</body>
</html>