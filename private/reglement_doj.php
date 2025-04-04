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
        <h1>Réglement et Fonctionnement du DOJ</h1>

        <div class="section-container">

            <div class="card"> Sommaire
                <div class="btn-container">
                    <a class="btn-sommaire" href="#civile"> 👤Plaintes Civiles </a>
                    <a class="btn-sommaire" href="#entreprise"> 🏭 Plaintes Entreprises </a>
                    <a class="btn-sommaire" href="#sp"> 🏥 Plaintes Services Publiques </a>
                    <a class="btn-sommaire" href="#compa"> ⏳ Comparutions immédiates </a>
                    <a class="btn-sommaire" href="#famille"> 💍 Procédure Familiale </a>
                    <a class="btn-sommaire" href="#prison"> 🔒 Prisonniers </a>
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

            <div class="card" id="civile">👤Plaintes Civiles
                <ul> 
                    Le dépôt des plaintes contre des civils s’effectue directement auprès du San Andreas State Police (SASP). Peu importe l’identité du plaignant (personne morale ou physique), le SASP est responsable du traitement de la plainte et doit assurer 
                    un suivi rigoureux de chaque dossier. Si le plaignat est un entreprise, elle doit obligatoirement passé par un avocat.
                    <br><br>
                    Un Substitut du Procureur, désigné au sein du Bureau du Procureur, est chargé de superviser le bon déroulement du traitement des plaintes et d’assurer leur conformité avec les procédures judiciaires.
                    <br><br>
                    <strong>📌 Rôle du Substitut du Procureur dans le Traitement des Plaintes </strong> <br><br>
                    <strong>✅ Supervision obligatoire pour les délits majeurs et crimes </strong>
                    <ul> Si les faits reprochés concernent un délit majeur ou un crime, le Substitut du Procureur doit obligatoirement être assigné à la plainte. <br>
                    Seul le Substitut peut autoriser le SASP à :
                        <ul> Appliquer une peine suite à une enquête concluante. </ul>
                        <ul> Classer l’affaire sans suite en cas de manque de preuves. </ul></ul>
                    <br>
                    <strong>✅ Les plaintes contre X sont automatiquement classées sans suite </strong>
                    <ul> Si une plainte est déposée sans identification formelle d’un suspect, elle est immédiatement classée sans suite.</ul>
                    <br>
                    <strong>✅ Obligation d’informer le plaignant </strong>
                    <ul> Il est du devoir du SASP et du Bureau du Procureur de tenir informé le plaignant ou son avocat de l’avancement de la procédure. </ul>
                    <br>
                    <strong>🚨 Application d’une Peine Suite à une Plainte</strong> <br>
                    L’application d’une peine à la suite d’une plainte suit la procédure classique 
                    <br><br>
                    ⚠️ Sans validation du Substitut du Procureur, aucune sanction ne peut être appliquée dans le cadre d’un délit majeur ou d’un crime.
                </ul>
            </div>

            <div class="card" id="entreprise"> 🏭 Plaintes Entreprises
                <ul> 
                    Le dépôt des plaintes contre une entreprise s’effectue directement auprès du San Andreas State Police (SASP). Peu importe l’identité du plaignant, qu’il s’agisse d’une personne physique (civil) ou d’une personne morale 
                    (entreprise, organisation), le Bureau du Procureur est chargé d’assurer un suivi rigoureux et de garantir le respect des procédures judiciaires.
                    <br><br>
                    Un Substitut du Procureur, désigné au sein du Bureau du Procureur, est responsable de la supervision de l’enquête et du bon déroulement de la procédure.
                    <br><br>
                    <strong>📌 Procédure d’Enquête et de Jugement</strong>
                    <strong>✅ Direction de l’enquête par le Bureau du Procureur</strong>
                    <ul>Le SASP suit les directives du Substitut du Procureur responsable du dossier. </ul>
                    <ul>Une enquête peut être ouverte si le Substitut estime qu’il existe des preuves ou des indices justifiant un examen approfondi. </ul>
                    <br>
                    <strong>✅ Obligation de représentation par un avocat pour les entreprises</strong>
                    <ul>Si le plaignant est une entreprise, elle doit obligatoirement être représentée par un avocat pour que la plainte soit recevable.</ul>
                    <br>
                    Cette obligation vise à garantir une procédure conforme et à éviter les abus.
                    <br><br>
                    <strong>✅ Différenciation des procédures selon le type de plaignant</strong><br>
                   <ul> <strong>1️⃣ Entreprise vs Entreprise</strong><br>
                    Lorsqu’une entreprise attaque une autre entreprise, un jugement devant un tribunal est obligatoire.
                    <br>
                    Seul un verdict judiciaire pourra déterminer l’issue du conflit et les sanctions applicables.</ul>
                    <br>
                    <ul> <strong>2️⃣ Civil vs Entreprise</strong><br>
                    Lorsqu’un citoyen attaque une entreprise, le Bureau du Procureur décide de l’orientation de l’affaire :
                    <ul>Si le dossier est suffisamment solide et nécessite une analyse approfondie, il sera envoyé devant un juge pour un procès. </ul>
                    <ul>Si l’affaire peut être réglée rapidement, elle sera traitée lors d’une comparution immédiate. </ul></ul>
                    <br>
                    <strong>📢 Conclusion</strong><br>
                    Le traitement des plaintes contre une entreprise est une procédure qui dépend du statut du plaignant et de la gravité des faits reprochés.
                    <ul> 🔹 Si la plainte est déposée par un civil → Le Bureau du Procureur choisit entre un jugement classique ou une comparution immédiate. </ul>
                    <ul> 🔹 Si la plainte est déposée par une entreprise contre une autre entreprise → Un jugement devant un tribunal est obligatoire. </ul>
                    <ul> 🔹 Si une enquête est nécessaire, elle est dirigée par un Substitut du Procureur et exécutée par le SASP. </ul>
                    <ul> 🔹 Un avocat est obligatoire pour une entreprise déposant une plainte.</ul>
                    <br>
                    <strong>💡 Cette procédure vise à assurer un cadre judiciaire strict et équitable pour les litiges impliquant des entreprises, tout en protégeant les droits des citoyens et des acteurs économiques.</strong>
                </ul>
            </div>

            <div class="card" id="sp"> 🏥 Plaintes Services Publiques
                <ul> 
                    Le dépôt des plaintes contre un service public s’effectue directement auprès du Département de la Justice (DOJ). Peu importe l’identité du plaignant, qu’il s’agisse d’une personne physique (citoyen) ou d’une personne morale 
                    (entreprise, organisation), c’est le Bureau du Procureur qui est responsable du traitement de la plainte et doit assurer un suivi rigoureux de chaque dossier.
                    <br><br>
                    Un Substitut du Procureur, désigné au sein du Bureau du Procureur, est responsable de la supervision de l’enquête et du bon déroulement de la procédure.
                    <br><br>
                    <strong>📌 Procédure d’Enquête et Résolution des Litiges</strong>
                    <strong>✅ Enquête menée par le Bureau du Procureur</strong>
                    <ul> Dès réception d’une plainte, un procureur est chargé de l’enquête pour déterminer si la plainte est justifiée ou non. </ul>
                    <ul> L’enquête vise à établir la véracité des faits et à analyser les responsabilités du service public concerné. </ul>
                    <br>
                    <strong>✅ Recherche d’un Arrangement avec le Service Concerné</strong>
                    <ul> Si la plainte est justifiée, le procureur responsable doit défendre les intérêts de l’État tout en cherchant une solution amiable entre le plaignant et le service public mis en cause. </ul>
                    <ul> Sanctions possibles : Si une faute est reconnue, des sanctions devront être appliquées aux responsables du service public concerné. </ul>
                    <br>
                    <strong>✅ Procédure en Cas d’Impossibilité d’Arrangement</strong>
                    <ul> Si aucun accord ne peut être trouvé entre le DOJ et le plaignant, ce dernier devra contacter un avocat privé afin de préparer un dossier contre l’État. </ul>
                    <ul> Transmission obligatoire du dossier :
                        <ul> Le procureur responsable de l’enquête doit transmettre son dossier à l’avocat du plaignant pour assurer la continuité de la procédure judiciaire.</ul>
                        <ul> Si le Bureau du Procureur refuse ou est incapable de fournir ce dossier, il sera lourdement sanctionné pour obstruction judiciaire.</ul></ul>
                    <br>
                    <strong>✅ Classement sans suite</strong>
                    <ul> Si l’enquête conclut à une absence de faute ou de preuve suffisante, le Bureau du Procureur peut classer la plainte sans suite.</ul>
                    <br>
                    <strong>📢 Conclusion</strong>
                    Le traitement des plaintes contre un service public est une procédure stricte qui impose une enquête approfondie menée par le Bureau du Procureur. L’objectif est d’assurer une justice équitable, 
                    tout en protégeant les droits des citoyens et en maintenant la responsabilité des services publics.
                    <ul> 🔹 Si la plainte est justifiée → Tentative d’arrangement, puis sanctions si nécessaire. </ul>
                    <ul> 🔹 Si aucun accord n’est trouvé → Transfert du dossier à l’avocat du plaignant pour poursuite judiciaire. </ul>
                    <ul> 🔹 Si la plainte est infondée → Classement sans suite par le Bureau du Procureur. </ul>
                    <br>
                    <strong>💡 Cette procédure vise à garantir une gestion efficace des plaintes tout en renforçant la transparence et la responsabilité des institutions publiques.</strong>
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

            <div class="card" id="prison">🔒 Prisonniers    
                <ul> 

                </ul>
            </div>

            <div class="card" id="jugeùent">👨‍⚖️ Jugement  
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

            <div class="card" id="patriot">🛡️ U.S. Patriot Act
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