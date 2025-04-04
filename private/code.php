<?php
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
require_once __DIR__ . '/../includes/database.php';

// Récupérer toutes les peines depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM peines ORDER BY id ASC");
$stmt->execute();
$peines = $stmt->fetchAll();
?>

<body class="reglement-body">

    <!-- ✅ Conteneur principal -->
    <div class="main-content">
        <h1>Les différents codes de l'Etat</h1>

        <!-- ✅ Boutons de sélection -->
        <div class="button-container">
            <button class="toggle-btn active" onclick="showSection('penal')">⚖️ Code Pénal</button>
            <button class="toggle-btn" onclick="showSection('travail')">📜 Code du Travail</button>
            <button class="toggle-btn" onclick="showSection('procedures')">🏛️ Code des Procédures</button>
            <button class="toggle-btn" onclick="showSection('peine')">⛓️ Code des Peines</button>
            <button class="toggle-btn" onclick="showSection('civil')">📝 Code Civil</button>
        </div>

        <!-- ✅ Section Code Pénal -->
        <div id="penal-section" class="section-container">
            <div class="card">
                Article I - Contrôle
                <ul> § Article 1.1	Toute personne à l'intérieur d'un périmètre de sécurité est susceptible d’être contrôlées et fouillées sans qu’aucune justification ne soit à donner.</ul>						
                <ul> § Article 1.2	Si aucune raison particulière, un agent ne pourra pas vous fouiller à moins de vous avoir pris en flagrant délit.</ul>								
                <ul> § Article 1.3	Chaque Citoyen doit être recensé par un agent des FDO (SASP) après son arrestation.</ul>						
                <ul> § Article 1.4	Le défaut de papiers officiels ( Identité, permis de conduire, PPA, PDC, VISA, Carte grise ) est le fait de ne pas posséder sur soi le papier. est passible de 1000 $ d'amende + convocation dans 48h avec présentation</ul>						
                <ul> §Article 1.5	Nul ne peut ignorer la loi et doit la respecter.</ul>							
            </div>
            <div class="card">Article II - Mandat
                <ul>§ Article 2.1 Un mandat de perquisition d'un suspect ne peut être délivré que par le Juge ou le Bureau du Procureur avec date et l'heure de délivrance (validité de 14 jours).</ul>						
                <ul>§ Article 2.2 La perquisition doit être effectuée en présence du propriétaire, qui dispose de 15 minutes pour se rendre sur les lieux, faute de quoi la fouille sera effectuée sans lui.</ul>						
                <ul>§ Article 2.3 Pendant la perquisition, les autorités doivent d'abord assurer la sécurité des lieux avant que le propriétaire, le juge ou le procureur ne puisse y pénétrer. Ensuite, ils peuvent entamer la fouille du bâtiment.</ul>						
                <ul>§ Article 2.4 Si un agent des forces de l'ordre constate un flagrant délit qui mène à s'introduire dans une propriété privée, celui-ci peut y accéder sans mandat.</ul>						
                <ul>§ Article 2.5 En l'absence d'un flagrant délit et sans appel d'urgence provenant de votre propriété privée, les FDO devront fournir un mandat pour y pénétrer sans le consentement du propriétaire.</ul>						
                <ul>§ Article 2.6 Le flagrant délit est une situation où une infraction est en train d'être commise ou vient d'être commise. L'individu est pris sur le fait ou immédiatement après, en possession d'indices laissant supposer sa participation à cette infraction.</ul>						
            </div>
            <div class="card">Article III - Fouilles
                <ul>§ Article 3.1 Fouille du téléphone : autorisée uniquement en cas d’enquête pour crime ou sur mandat délivré par un membre du DOJ.</ul>						
                <ul>§ Article 3.2 Fouille corporelle après la palpation et lecture des droits.</ul>						
                <ul>§ Article 3.3 Fouille corporelle autorisée si la personne est impliquée ou présente dans une zone d'intervention des FDO, ou suite à des coups de feu, un délit majeur ou un crime dans le périmètre.</ul>						
                <ul>§ Article 3.4 Fouille du véhicule autorisée après la commission d’un délit (infraction / délit / crime) ou en cas de présence sur une intervention des FDO.</ul>						
            </div>
            <div class="card">Article IV - Code de la route
                <ul>§ Article 4.1 Toute personne refusant de s'arrêter à la suite d'un signal sonore (Gyrophare) est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 4.2 Toute personne conduisant illégalement un véhicule nécessitant un permis de conduire se verront amendés + garde à vue.</ul>
                <ul>§ Article 4.3 La conduite sous ivresse et / ou l'emprise de stupéfiant est le fait de conduire un véhicule avec un taux d'alcool supérieur à 0 et / ou sous stupéfiant est passible d'une amende + garde à vue + retrait du permis de conduire + Blocage du véhicule.</ul>
                <ul>§ Article 4.4 La conduite dangereuse consiste à conduire un moyen de transport de façon dangereuse pour autrui ou pour soi-même est passible d'une amende + garde à vue + retrait du permis de conduire + Blocage du véhicule.</ul>
                <ul>§ Article 4.5 Le délit de fuite est le fait qu'un responsable d'un accident, qu'il soit conducteur d'un véhicule, cycliste ou piéton, quitte les lieux afin d'échapper à ses responsabilités est passible d'une amende + garde à vue + retrait du permis de conduire + Blocage du véhicule.</ul>
            </div>
            <div class="card">Article V - Armes
                <ul>§ Article 5.1 Toute personne possédant une arme à feu sans PPA se verra amendée + garde à vue.</ul>
                <ul>§ Article 5.2 Toute personne possédant une arme à feu de catégorie B / C ou D sera arrêtée et peut risquer une lourde amende et une peine de prison.</ul>
                <ul>§ Article 5.3 Toute personne conduisant un véhicule contenant une arme à feu dans le coffre ou la boîte à gants se verra amendée + garde à vue.</ul>
                <ul>§ Article 5.4 Trafic d'armes : toute personne dont il est avéré qu'elle construit ou vend des armes illégales sera arrêtée et sera condamnée à une amende de 25 000$ et une peine de prison fédérale de 3 UP.</ul>
                <ul>§ Article 5.5 Toute personne possédant des munitions d'arme à feu sans PPA se verra amendée + garde à vue.</ul>
                <ul>§ Article 5.6 Toute personne possédant des armes explosives sera considérée comme terroriste (prison fédérale à perpétuité).</ul>
            </div>
            <div class="card">Article VI - Drogues
                <ul>§ Article 6.1 La possession de meth, cocaïne, crack est un délit (+ ou = 50 pochons est défini comme Trafic de stupéfiants). Celui-ci est passible d'une amende + garde à vue + bracelet électronique.</ul>
                <ul>§ Article 6.2 Le trafic de drogue s'apparente à la récolte, production, fabrication, importation, exportation, transport, détention, offre, vente, achat et emploi illicites de stupéfiants.</ul>
                <ul>§ Article 6.3 La qualification du délit lié à la possession de moins de 10 pots est assimilée à de la plantation (délit mineur). Cependant, si l'individu détient plus de 10 pots, le délit sera requalifié en trafic de drogues.</ul>
                <ul>§ Article 6.4 Trafic de drogue : lourde amende + bracelet électronique + possible jugement.</ul>
                <ul>§ Article 6.5 La possession de graines pouvant être transformées en drogue est illégale. Cela s'apparente à la possession de matière première (graines de weed, cocaïne, ammoniaque). 
                Le méthylamine est illégal. Si toutefois l'individu est présent sur la zone d'une récolte, de production ou de fabrication, il sera considéré comme impliqué dans un trafic de drogue.</ul>
            </div>
            <div class="card">Article VII - Argent
                <ul>§ Article 7.1 Toute personne possédant plus de 4000 $ d'argent liquide sans justificatif pourra voir son argent saisi.</ul>
                <ul>§ Article 7.2 Toute personne dont le blanchiment a été avéré risque une lourde amende (20$ x quantité d'argent blanchi) et une peine de prison fédérale de 2 UP.</ul>
                <ul>§ Article 7.3 Toute personne ne payant pas les impôts d'entreprise verra son entreprise saisie + amende de 45 000$.</ul>
                <ul>§ Article 7.4 Le détournement de fonds désigne le fait, par une personne, de détruire, détourner ou soustraire un acte ou un titre, ou des fonds, ou effets, pièces ou titres en tenant lieu, ou tout autre objet qui lui a été remis en raison de ses fonctions ou de sa mission. Ce crime est passible de 25 000$ d’amende et une peine de prison fédérale de 5 UP.</ul>
                <ul>§ Article 7.5 Toute personne ne payant pas ses amendes pourra voir son argent saisi à la source. En cas de non-paiement d'une amende, l'IRS aura le droit de saisir tous les biens de valeur, tels que véhicules, propriétés, liquidités, bijoux et vêtements de luxe. Sanctions possibles : Amende + TIG + Bracelet électronique. En cas d’impossibilité de paiement, la somme totale sera convertie en UP.</ul>
                <ul>§ Article 7.6 La corruption est la perversion ou le détournement d'un processus ou d'une interaction avec une ou plusieurs personnes dans le dessein, pour le corrupteur, d'obtenir des avantages ou des prérogatives particulières ou, pour le corrompu, d'obtenir une rétribution en échange de sa complaisance. Ce crime est passible de 60 000$ d’amende + Prison fédérale 2 UP.</ul>
            </div>
            <div class="card">Article VIII - Braquages
                <ul>§ Article 8.1 Le braquage sur civil à l'aide d'une arme à feu est passible d'une amende, saisie de l'arme et des munitions + garde à vue + TIG + Bracelet électronique.</ul>
                <ul>§ Article 8.2 Le braquage à l'aide d'une arme à feu contre un agent du service public est passible d'une amende, du retrait de l'arme et des munitions + garde à vue + Bracelet électronique.</ul>
                <ul>§ Article 8.3 Le braquage est le fait de soustraire par la force ou la contrainte le contenu d'un coffre ou de tout autre objet. Celui-ci est passible d'une amende + saisie des armes & argent + garde à vue.</ul>
                <ul>§ Article 8.4 Le braquage d'un convoi pénitencier est le fait d'organiser et d'appliquer l'évasion d'un individu par la force ou la contrainte. Celui-ci est passible d'une amende de 20 000$ + saisie des armes et munitions + prison fédérale 1 UP.</ul>
                <ul>§ Article 8.5 Le braquage d'un établissement de l'État dans lequel sont rassemblées et classées des collections d'objets d'intérêt historique, technique, scientifique, artistique ou gouvernemental est passible d'une amende de la valeur totale des objets volés dans la quantité + 20 000$ + saisie des armes, munitions et argent + garde à vue + prison fédérale 3 UP.</ul>
            </div>
            <div class="card">Article IX - Meurtres / Homicide
                <ul>§ Article 9.1 La tentative de meurtre sur civil est constituée dès lors qu’elle est manifestée par un commencement d'exécution. Celle-ci est passible de 10 000$ d’amende + saisie des armes + 1 UP de prison.</ul>
                <ul>§ Article 9.2 La tentative de meurtre sur un FDO ou employé de l'État est constituée dès lors qu’elle est manifestée par un commencement d'exécution. Celle-ci est passible de 15 000$ d’amende + saisie des armes + 1 UP de prison.</ul>
                <ul>§ Article 9.3 Le meurtre sur civil est le fait de donner intentionnellement la mort à un civil. Celui-ci est passible de 45 000$ d’amende + saisie des armes et munitions + 7 UP de prison.</ul>
                <ul>§ Article 9.4 Le meurtre sur un agent des forces de l'ordre est le fait de donner intentionnellement la mort à un FDO. Celui-ci est passible de 60 000$ d’amende + saisie des armes et munitions + 10 UP de prison.</ul>
                <ul>§ Article 9.5 Le meurtre sur un Haut Fonctionnaire est le fait de donner intentionnellement la mort à un magistrat, un membre de l'État-Major ou du cabinet du gouverneur. Celui-ci est passible de 150 000$ d’amende + saisie des armes et munitions + réclusion à perpétuité.</ul>
                <ul>§ Article 9.6 L'assassinat est une action visant à tuer volontairement une personne de manière préméditée.</ul>
                <ul>§ Article 9.7 L’homicide est le fait de donner non-intentionnellement la mort à un civil.</ul>
            </div>
            <div class="card">Article X - Faux
                <ul>§ Article 10.1 Le parjure est le témoignage mensonger ou les fausses accusations sous serment. Celui-ci est passible de 10 000$ d'amende + garde à vue.</ul>
                <ul>§ Article 10.2 Faux et usage de faux : Le faux désigne toute altération frauduleuse de la vérité dans le but de causer un préjudice à un tiers. L’usage de faux est le fait d'exploiter un faux en toute connaissance de cause dans l'objectif d'avoir les mêmes effets qu'avec la pièce originale. Celui-ci est passible d'une lourde amende + garde à vue.</ul>
                <ul>§ Article 10.3 L'usurpation d'identité consiste à utiliser, sans l'accord de la personne, des informations permettant de vous identifier. Celle-ci est passible d'une lourde amende.</ul>
            </div>
            <div class="card">Article XI - Otages et Agression
                <ul>§ Article 11.1 La prise d'otage sur civil est une action visant à retenir un ou des civils contre leur volonté afin de revendiquer quelque chose. Celle-ci est passible de 5 000$ + saisie des armes et munitions + garde à vue.</ul>
                <ul>§ Article 11.2 La prise d'otage sur agent du service public est une action visant à retenir un ou des agents du service public contre leur volonté afin de revendiquer quelque chose. Celle-ci est passible de 10 000$ + saisie des armes et munitions + garde à vue.</ul>
                <ul>§ Article 11.3 La prise d'otage sur haut fonctionnaire est une action visant à retenir un ou des hauts fonctionnaires contre leur volonté afin de revendiquer quelque chose. Celle-ci est passible de 15 000$ + saisie des armes et munitions + 1 UP de prison.</ul>
                <ul>§ Article 11.4 Le kidnapping est l'action qui consiste à s'emparer de quelqu'un contre sa volonté, par la force, dans l'intention de l'échanger contre une rançon ou une compensation en nature (libération de prisonniers, fourniture d'armes). Celle-ci est passible de 12 000$ + saisie des armes et munitions + 5 UP de prison.</ul>
                <ul>§ Article 11.5 L'agression sur concitoyen est une attaque non provoquée, injustifiée et brutale à l'aide de ses mains, d'une arme blanche et/ou contondante contre un concitoyen. Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 11.6 L’agression sur agent du service public est une attaque injustifiée et brutale à l'aide de ses mains, d'une arme blanche et/ou contondante contre un agent du service public. Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 11.7 Le harcèlement est une violence fondée sur des rapports de domination et d'intimidation qui a pour objet ou effet une dégradation des conditions de vie de la victime et un impact sur sa santé physique ou psychique. Celle-ci est passible d'une amende + garde à vue + injonction d'éloignement.</ul>
                <ul>§ Article 11.8 La menace de mort sur civil est une violence qui consiste à transmettre à une autre personne une menace de tuer un civil ou de lui causer des lésions corporelles. Elle doit être avérée par des preuves et des témoins. Celle-ci est passible d'une amende + garde à vue + injonction.</ul>
                <ul>§ Article 11.9 La mise en danger de la vie d'autrui est le fait d'exposer autrui à un risque de mort ou de blessures importantes, sans accident, sans dommage, sans violence et sans agression. Celle-ci est passible d'une amende + garde à vue + injonction.</ul>
                <ul>§ Article 11.10 La non-assistance à une personne en danger est le fait de ne pas porter secours à quelqu'un en détresse. Celle-ci est passible d'une amende de 1 500$ + garde à vue.</ul>
            </div>
            <div class="card">Article XII - Non Respect
                <ul>§ Article 12.1 Le refus d’obtempérer et/ou de coopérer est un délit, se caractérisant par le fait qu'un individu choisisse de ne pas s’arrêter ou d’exécuter un ordre donné par un agent. Celui-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 12.2 Le trouble à l'ordre public est l’atteinte significative à la paix publique. Certaines libertés peuvent faire l'objet de restrictions lorsqu'elles vont à l'encontre de l'ordre public. Celui-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 12.3 L'entrave (Enquête / Justice / Action de Police) est un délit d’interférence dans le travail des magistrats ou de tout autre agent dépositaire de l'autorité publique. Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 12.4 La cavale est un état de fuite de quelqu'un recherché par le SASP. Celle-ci est passible de prison fédérale.</ul>
                <ul>§ Article 12.5 Le non-respect de présence lors des Travaux d'Intérêt Général (TIG) est passible de 1 UP de prison fédérale.</ul>
                <ul>§ Article 12.6 Les citoyens ont le droit de s'exprimer librement, y compris de critiquer et de contredire d'autres personnes.</ul>
                <ul>§ Article 12.7 La diffamation est une déclaration fausse et préjudiciable faite de manière intentionnelle ou négligente à l'encontre de quelqu'un. Celle-ci est passible de 10 000$ d'amende.</ul>
            </div>
            <div class="card">Article XIII - Incivilités
                <ul>§ Article 13.1 La dégradation de biens publics est le fait de détruire, dégrader ou vandaliser volontairement un bien public. Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 13.2 La dégradation de biens privés est le fait de détruire, dégrader ou vandaliser volontairement un bien privé. Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 13.3 La dégradation sur un véhicule d’État est la détérioration volontaire d'un véhicule appartenant à l’État. Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 13.4 Le graffiti ou tag est une dégradation de biens (voir s'il est public ou privé). Celle-ci est passible d'une amende + garde à vue.</ul>
                <ul>§ Article 13.5 La dissimulation de preuves est le fait de faire obstacle à la manifestation de la vérité, soit par le fait de détruire, soustraire, receler ou altérer un document public ou privé ou un objet facilitant la découverte d'un crime ou d'un délit. Celle-ci est passible de 15 000$ d'amende.</ul>
                <ul>§ Article 13.6 L'attentat à la pudeur est une infraction pénale par laquelle un individu commet une voie de fait dans des circonstances indécentes contre la pudeur d'une autre personne. Celle-ci est passible de 800$ d'amende.</ul>
                <ul>§ Article 13.7 La dissimulation du visage est interdite sur la voie publique (dans la rue, au volant...), dans les lieux ouverts au public (magasin, banque, cinéma...). Celle-ci est passible de 500$ d'amende.</ul>
                <ul>§ Article 13.8 L’ivresse sur la voie publique est le fait d'être en état d'ébriété sur la voie publique. Celle-ci est passible de 500$ d'amende.</ul>
                <ul>§ Article 13.9 Le stationnement interdit ou gênant est l'immobilisation d'un véhicule sur un emplacement inadéquat, gênant les autres usagers de la route ou du domaine public. Celle-ci est passible de sabotage si absence du conducteur et mise en circulation après paiement de la fourrière, ou d'une contravention.</ul>
                <ul>§ Article 13.10 La violation de propriété privée est l'intrusion dans une propriété privée sans y être invité. Celle-ci est passible de 1 500$ d'amende.</ul>
                <ul>§ Article 13.11 L'outrage à agent englobe des comportements affectant la dignité et le respect associés à la fonction d'un agent public, y compris l'entrave à la justice, le refus de coopérer lors d'une arrestation, et le non-respect d'une demande légale d'un agent en fonction. Celle-ci est passible de 2 000$ d'amende.</ul>
            </div>
            <div class="card">Article XIV - Trahison et Terrorisme
                <ul>§ Article 14.1 Une attaque gouvernementale est une attaque provoquée contre le gouvernement afin de nuire à la prospérité du pays. Celle-ci est considérée comme un acte de terrorisme.</ul>
                <ul>§ Article 14.2 Une attaque du poste de police est une attaque provoquée contre les forces de l'ordre afin de nuire à la sécurité publique. Celle-ci est considérée comme un acte de terrorisme.</ul>
                <ul>§ Article 14.3 Un attentat est une action destinée à nuire (à attenter) aux biens ou à la vie d'autrui. Celui-ci est considéré comme un acte de terrorisme.</ul>
                <ul>§ Article 14.4 Le terrorisme est l'emploi de la terreur à des fins idéologiques, politiques ou religieuses. Celui-ci est passible de la peine de mort + 200 000$ d'amende.</ul>
                <ul>§ Article 14.5 La haute trahison est un crime qui consiste en un acte de déloyauté extrême envers son pays, son chef d'État ou son gouvernement. Ce crime est passible de la prison à vie.</ul>
            </div>
            <div class="card">Article XV - Vice
                <ul>§ Article 15.1 Un vice de procédure ne remet en cause que ce qui en découle directement. Si une accusation repose sur plusieurs éléments et qu'un seul est concerné par un vice de procédure, seul cet élément sera annulé.</ul>
                <ul>§ Article 15.2 La non-citation des droits ou l'absence de suspicion raisonnable motivant une arrestation ou une fouille rend les découvertes consécutives caduques.</ul>
                <ul>§ Article 15.3 Toute preuve trouvée lors d'une fouille illégale ou faite au cours d'une arrestation illégale est nulle et n'a pas de valeur probante.</ul>
                <ul>§ Article 15.4 Si les forces de l'ordre requièrent un avocat pour le suspect ou l'accusé qui en désire un, mais qu'aucun n'est disponible, alors l'arrestation n'est pas nulle. Cependant, il faut prouver que tous les efforts ont été mis en œuvre et que ceux-ci sont restés sans effet.</ul>
                <ul>§ Article 15.5 Lorsque le juge ou procureur reconnaît formellement qu'un vice de procédure a été commis, toute personne est tenue d'en tirer les conséquences légales.</ul>
                <ul>§ Article 15.6 En cas de vide juridique, c'est-à-dire lorsqu'il n'existe aucune loi ou réglementation applicable à une situation donnée, le magistrat (DOJ) doit interpréter la loi existante de manière à résoudre le litige en question.</ul>
                <ul>§ Article 15.7 Si l'interprétation de la loi existante ne permet pas de résoudre le litige, le juge peut faire appel à la jurisprudence ou aux principes généraux du droit. Toutefois, le juge ne peut pas créer de nouvelle loi ou réglementation pour combler un vide juridique.</ul>
            </div>
            <div class="card">Article XVI - Actes commis en groupe
                <ul>§ Article 16.1 L'association de malfaiteurs et l'infraction commise en bande organisée est un groupement d'individus (au moins 2 personnes) formé en vue de la préparation d'un ou plusieurs crimes ou délits. Celle-ci est passible de 7 500$ d’amende + garde à vue ou détention provisoire.</ul>
                <ul>§ Article 16.2 Une émeute est une manifestation populaire agitée, généralement spontanée et violente. Celle-ci est passible d'une amende + garde à vue + bracelet électronique.</ul>
                <ul>§ Article 16.3 Une manifestation est autorisée, mais sa déclaration auprès du gouvernement ou de l'état-major est obligatoire. Sans document attestant cette déclaration, la manifestation sera considérée comme illégale et sera passible d'une amende + garde à vue.</ul>
                <ul>§ Article 16.4 L’évasion est le fait pour un individu de s’échapper soit de la prison, soit d’un lieu où il est retenu par le SASP. Celle-ci est passible d'une amende de 10 000$ + prison fédérale à vie.</ul>
                <ul>§ Article 16.5 L'aide à l'évasion, quel que soit le degré d'implication, est passible d'une amende de 10 000$ et d'une peine de prison fédérale à perpétuité.</ul>
                <ul>§ Article 16.6 Le mandat criminel se caractérise par le fait de faire des offres ou des promesses à une personne, ou de lui proposer des dons, présents ou avantages quelconques, afin que cette dernière commette un crime, notamment un assassinat ou un kidnapping. Celle-ci est passible de 50 000$ d'amende.</ul>
            </div>
        </div>  

        <!-- ✅ Section Code du Travail -->
        <div id="travail-section" class="section-container hidden">
            <div class="card">En cours
            </div>
        </div>

        <!-- ✅ Section Code des Procédures -->
        <div id="procedures-section" class="section-container hidden">
            <div class="card">En cours
            </div>
        </div>

        <!-- ✅ Section Code des Peines -->
        <div id="peine-section" class="section-container hidden">

            <!-- ✅ Barre de recherche -->
            <input type="text" id="searchBar" placeholder="Rechercher un fait d'inculpation..." onkeyup="searchCOP()">

            <div>
                <h2> Les Contraventions </h2>
                <table class="peines-table">
                    <thead>
                        <tr>
                            <th>Fait</th>
                            <th>Type de Peine</th>
                            <th>Amende</th>
                            <th>GAV</th>
                            <th>UP</th>
                            <th>Explications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peines as $peine): ?>
                            <?php if ($peine['type_de_peine'] === 'Contravention'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($peine['fait']); ?></td>
                                    <td><?= htmlspecialchars($peine['type_de_peine']); ?></td>
                                    <td><?= htmlspecialchars($peine['amende']); ?>$</td>
                                    <td><?= htmlspecialchars($peine['gav']); ?></td>
                                    <td><?= htmlspecialchars($peine['up']); ?></td>
                                    <td><?= htmlspecialchars($peine['explications']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div>
                <h2> Les Délits Mineurs </h2>
                <table class="peines-table">
                    <thead>
                        <tr>
                            <th>Fait</th>
                            <th>Type de Peine</th>
                            <th>Amende</th>
                            <th>GAV</th>
                            <th>UP</th>
                            <th>Explications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peines as $peine): ?>
                            <?php if ($peine['type_de_peine'] === 'Délit Mineur'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($peine['fait']); ?></td>
                                    <td><?= htmlspecialchars($peine['type_de_peine']); ?></td>
                                    <td><?= htmlspecialchars($peine['amende']); ?>$</td>
                                    <td><?= htmlspecialchars($peine['gav']); ?></td>
                                    <td><?= htmlspecialchars($peine['up']); ?></td>
                                    <td><?= htmlspecialchars($peine['explications']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div>
                <h2> Les Délits Majeurs </h2>
                <table class="peines-table">
                    <thead>
                        <tr>
                            <th>Fait</th>
                            <th>Type de Peine</th>
                            <th>Amende</th>
                            <th>GAV</th>
                            <th>UP</th>
                            <th>Explications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peines as $peine): ?>
                            <?php if ($peine['type_de_peine'] === 'Délit Majeur'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($peine['fait']); ?></td>
                                    <td><?= htmlspecialchars($peine['type_de_peine']); ?></td>
                                    <td><?= htmlspecialchars($peine['amende']); ?>$</td>
                                    <td><?= htmlspecialchars($peine['gav']); ?></td>
                                    <td><?= htmlspecialchars($peine['up']); ?></td>
                                    <td><?= htmlspecialchars($peine['explications']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div> 
                <h2> Les Crimes </h2>
                <table class="peines-table">
                    <thead>
                        <tr>
                            <th>Fait</th>
                            <th>Type de Peine</th>
                            <th>Amende</th>
                            <th>GAV</th>
                            <th>UP</th>
                            <th>Explications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peines as $peine): ?>
                            <?php if ($peine['type_de_peine'] === 'Crime'): ?>
                                <tr>
                                    <td><?= htmlspecialchars($peine['fait']); ?></td>
                                    <td><?= htmlspecialchars($peine['type_de_peine']); ?></td>
                                    <td><?= htmlspecialchars($peine['amende']); ?>$</td>
                                    <td><?= htmlspecialchars($peine['gav']); ?></td>
                                    <td><?= htmlspecialchars($peine['up']); ?></td>
                                    <td><?= htmlspecialchars($peine['explications']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- ✅ Section Code Civils -->
        <div id="civil-section" class="section-container hidden">
            <div class="card">Chapitre I - Droits Immuables
                <ul>§ Article 1.1 Tout citoyen étant né sur le territoire de San Andreas et ayant ses papiers a le droit de vote.</ul>
                <ul>§ Article 1.2 Tout citoyen étant de nationalité États-Unienne peut circuler librement sur le territoire de San Andreas, si celui-ci respecte la législation en vigueur.</ul>
                <ul>§ Article 1.3 Tout citoyen, sauf indication contraire, étant majeur peut porter une arme à feu dans le respect de la législation en vigueur.</ul>
                <ul>§ Article 1.4 La loi ne dispose que pour l'avenir ; elle n'a point d'effet rétroactif.</ul>
                <ul>§ Article 1.5 Nul ne peut ignorer la loi et doit la respecter.</ul>
                <ul>§ Article 1.6 Tout citoyen a le devoir d'assistance envers son prochain, au risque d'être poursuivi pour non-assistance à personne en danger en vertu de l'article XXX du Code Pénal.</ul>
                <ul>§ Article 1.7 Chacun a droit au respect de sa vie privée. Les juges peuvent, sans préjudice de la réparation du dommage subi, prescrire toutes mesures, telles que séquestre, saisie et autres, propres à empêcher ou faire cesser une atteinte à l'intimité de la vie privée : ces mesures peuvent, s'il y a urgence, être ordonnées en référé.</ul>
                <ul>§ Article 1.8 Tout regroupement de personnes sur la voie publique, spontané ou non, à l'occasion d'un événement ou ayant un caractère revendicatif ou symbolique, le tout n'étant pas déclaré pourra se voir interdit et réprimandé conformément au Code Pénal.</ul>
                <ul>§ Article 1.8.1 Toute manifestation ou rassemblement doit au préalable être déclaré auprès de l'état-major du SASP par les organisateurs en donnant les critères suivants : Date + Heure + Motif + Lieu + Identité de l'organisateur.</ul>
                <ul>§ Article 1.8.2 Les manifestations ou rassemblements peuvent être interdits par décision de l'état-major pour des raisons de sécurité publique.</ul>
                <ul>§ Article 1.9 Toute personne qui justifie d'un intérêt légitime peut demander à changer de nom auprès du ministère de la justice qui pourra accéder ou non à la requête.</ul>
                <ul>§ Article 1.10 Le changement de nom s'étend de plein droit aux enfants du bénéficiaire lorsqu'ils ont moins de treize ans.</ul>
                <ul>§ Article 1.11 Toute personne majeure ou mineure émancipée qui démontre par une raison suffisante de faits que la mention relative à son sexe dans les actes de l'état civil ne correspond pas à celui dans lequel elle se présente et dans lequel elle est connue peut en obtenir la modification par le biais d’une décision d’une cour de justice.</ul>
            </div>
            <div class="card">Chapitre II - Libre Circulation
                <ul>§ Article 2.1 Il est interdit de s'introduire, sans y être invité ou raison valable, au sein des lieux suivants : Poste de police / Prison / Gouvernement / Palais de Justice / Base militaire / Aéroport.</ul>
                <ul>§ Article 2.2 Toute infraction à l'article précédent est punissable d'une amende, conformément au Code Pénal.</ul>
                <ul>§ Article 2.3 Chaque citoyen bénéficie du droit de circuler librement sur la voie publique. Ce droit peut être temporairement restreint par une procédure judiciaire ou administrative sur une zone définie. La liberté de circuler ne s’applique pas aux zones militaires, aux locaux institutionnels et aux zones privées.</ul>
            </div>
            <div class="card">Chapitre III - Droits de Propriété
                <ul>§ Article 3.1 La propriété est le droit d'user, de jouir et de disposer d'une chose de manière propre, exclusive et absolue sous les restrictions établies par la loi.</ul>
                <ul>§ Article 3.2 Les particuliers ont la libre disposition des biens qu'ils possèdent ; ils peuvent donc décider librement d'user ou non de leurs biens, de céder ou non leurs biens, de donner ou non leurs biens.</ul>
                <ul>§ Article 3.3 Tout citoyen, décédé, qui ne paye pas son loyer ou quitte notre ville, verra son bien, dans un délai raisonnable, être saisi par l'État.</ul>
                <ul>§ Article 3.4 La propriété est le droit de jouir et de disposer des choses de la manière la plus absolue, pourvu qu'on n'en fasse pas un usage prohibé par les lois ou par les règlements.</ul>
                <ul>§ Article 3.5 Nul ne peut être contraint de céder sa propriété, si ce n'est pour cause d'utilité publique, et moyennant une juste et préalable indemnité.</ul>
                <ul>§ Article 3.6 La propriété d'une chose, soit mobilière, soit immobilière, donne droit sur tout ce qu'elle produit et sur ce qui s'y unit accessoirement, soit naturellement, soit artificiellement. Ce droit s'appelle "droit d'accession".</ul>
                <ul>§ Article 3.7 Propriété Intellectuelle - L'auteur jouit du droit au respect de son nom, de sa qualité et de son œuvre. Ce droit est attaché à sa personne. Il est perpétuel, inaliénable et imprescriptible.</ul>
                <ul>§ Article 3.8 Propriété Intellectuelle - Ont la qualité d'auteur d'une œuvre radiophonique ou graphique la ou les personnes physiques qui assurent la création intellectuelle de cette œuvre.</ul>
                <ul>§ Article 3.9 Propriété Intellectuelle - Sont considérés notamment comme œuvres de l'esprit au sens du présent code :
                    <ul>1. Les livres, brochures et autres écrits littéraires, artistiques et scientifiques.</ul>
                    <ul>2. Les conférences, allocutions, sermons, plaidoiries et autres œuvres de même nature.</ul>
                    <ul>3. Les œuvres dramatiques ou dramatico-musicales.</ul>
                    <ul>4. Les œuvres chorégraphiques, les numéros et tours de cirque, les pantomimes, dont la mise en œuvre est fixée par écrit ou autrement.</ul>
                    <ul>5. Les compositions musicales avec ou sans paroles.</ul>
                    <ul>6. Les œuvres cinématographiques et autres œuvres consistant en des séquences animées d'images, sonorisées ou non, dénommées ensemble œuvres audiovisuelles.</ul>
                    <ul>7. Les œuvres de dessin, de peinture, d'architecture, de sculpture, de gravure, de lithographie.</ul>
                    <ul>8. Les œuvres graphiques et typographiques.</ul>
                    <ul>9. Les œuvres photographiques et celles réalisées à l'aide de techniques analogues à la photographie.</ul>
                    <ul>10. Les œuvres des arts appliqués.</ul>
                    <ul>11. Les illustrations, les cartes géographiques.</ul>
                    <ul>12. Les plans, croquis et ouvrages plastiques relatifs à la géographie, à la topographie, à l'architecture et aux sciences.</ul>
                    <ul>13. Les logiciels.</ul>
                </ul>
                <ul>§ Article 3.10 L'œuvre de collaboration est la propriété commune des coauteurs. Les coauteurs doivent exercer leurs droits d'un commun accord. En cas de désaccord, il appartient à la juridiction civile de statuer.</ul>
            </div>
            <div class="card">Chapitre IV - Union Civile
                <ul>§ Article 4.1 Tout citoyen jouit du droit de s’unir au moyen d’un mariage déclaré à l’officier d’état civil, ou par filiation.</ul>
                <ul>§ Article 4.1.1 Le mariage ne peut être contracté avant 21 ans révolus.</ul>
                <ul>§ Article 4.1.2 Il n'y a pas de mariage lorsqu'il n'y a point de consentement.</ul>
                <ul>§ Article 4.1.3 On ne peut contracter un second mariage avant la dissolution du premier.</ul>
                <ul>§ Article 4.1.4 En ligne collatérale, le mariage est prohibé entre le frère et la sœur, entre frères et entre sœurs.</ul>
                <ul>§ Article 4.1.5 En ligne directe, le mariage est prohibé entre tous les ascendants et descendants et les alliés dans la même ligne.</ul>
                <ul>§ Article 4.1.6 Toute union doit s’accompagner d’un acte attestant de la volonté propre de ceux-ci de faire valoir leur droit.</ul>
                <ul>§ Article 4.1.7 Un acte de mariage doit être rédigé et signé de la main d’un juge.</ul>
                <ul>§ Article 4.1.8 L’acte de mariage doit être transmis à l’officier d’état civil (Maire ou Gouverneur) ayant juridiction sur le domicile des intéressés. Celui-ci pourra, sur demande, procéder à un changement de nom justifié conformément aux procédures civiles en vigueur sur le territoire.</ul>
                <ul>§ Article 4.1.9 Le mariage déclaré nul par une décision émanant d'une juridiction étrangère dont l'autorité est reconnue à San Andreas rend caduque toute déclaration.</ul>
                <ul>§ Article 4.2 Les époux contractent ensemble, par le seul fait du mariage, l'obligation de nourrir, entretenir et élever leurs enfants.</ul>
                <ul>§ Article 4.2.1 L'enfant n'a pas d'action contre ses père et mère pour un établissement par mariage ou autrement.</ul>
                <ul>§ Article 4.2.2 Les époux se doivent mutuellement respect, fidélité, secours, assistance.</ul>
                <ul>§ Article 4.2.3 Les époux assurent ensemble la direction morale et matérielle de la famille. Ils pourvoient à l'éducation des enfants et préparent leur avenir.</ul>
                <ul>§ Article 4.2.4 Les époux s'obligent mutuellement à une communauté de vie.</ul>
                <ul>§ Article 4.2.5 Chaque époux a la pleine capacité de droit.</ul>
                <ul>§ Article 4.2.6 Chacun des époux perçoit ses gains et salaires et peut en disposer librement après s'être acquitté des charges du mariage.</ul>
                <ul>§ Article 4.3 Le mariage se dissout : 1° Par la mort de l'un des époux ; 2° Par le divorce légalement prononcé.</ul>
                <ul>§ Article 4.3.1 Les époux peuvent consentir mutuellement à leur divorce par acte sous signature privée contresigné par avocats.</ul>
                <ul>§ Article 4.3.2 En cas de litige lié à un divorce, le juge examine la demande avec chacun des époux, puis les réunit. Il appelle ensuite le ou les avocats.</ul>
                <ul>§ Article 4.3.3 Le divorce peut être demandé conjointement par les époux lorsqu'ils acceptent le principe de la rupture du mariage sans considération des faits à l'origine de celle-ci.</ul>
                <ul>§ Article 4.3.4 S'il a acquis la conviction que chacun des époux a donné librement son accord, le juge prononce le divorce et statue sur ses conséquences.</ul>
                <ul>§ Article 4.3.5 Le divorce peut être demandé par l'un des époux lorsque des faits constitutifs d'une violation grave ou renouvelée des devoirs et obligations du mariage sont imputables à son conjoint et rendent intolérable le maintien de la vie commune.</ul>
                <ul>§ Article 4.3.6 Les débats sur la cause, les conséquences du divorce et les mesures provisoires ne sont pas publics.</ul>
                <ul>§ Article 4.3.7 La demande en divorce est présentée par les avocats respectifs des parties ou par un avocat choisi d'un commun accord. Le juge examine la demande avec chacun des époux, puis les réunit.</ul>
            </div>
            <div class="card">Chapitre V - Médiation Familiale
                <ul>§ Article 5.1 Lorsque les violences exercées au sein du couple, y compris lorsqu'il n'y a pas de cohabitation, ou par un ancien conjoint, y compris lorsqu'il n'y a jamais eu de cohabitation, mettent en danger la personne qui en est victime, un ou plusieurs enfants, le juge de la Cour Suprême peut délivrer en urgence à cette dernière une ordonnance de protection.</ul>
                <ul>§ Article 5.1.1 L'ordonnance de protection est délivrée par le juge, saisi par la personne en danger, si besoin assistée, ou, avec l'accord de celle-ci, par le ministère public. Sa délivrance n'est pas conditionnée à l'existence d'une plainte pénale préalable. Dès la réception de la demande d'ordonnance de protection, le juge convoque, par tous moyens adaptés, pour une audience, la partie demanderesse et la partie défenderesse, assistées, le cas échéant, d'un avocat, ainsi que le ministère public à fin d'avis. Ces auditions peuvent avoir lieu séparément. L'audience se tient en chambre du conseil. À la demande de la partie demanderesse, les auditions se tiennent séparément.</ul>
                <ul>§ Article 5.1.2 L'ordonnance de protection est délivrée, par le juge, dans un délai maximal de six jours à compter de la fixation de la date de l'audience, s'il estime, au vu des éléments produits devant lui et contradictoirement débattus, qu'il existe des raisons sérieuses de considérer comme vraisemblables la commission des faits de violence allégués et le danger auquel la victime ou un ou plusieurs enfants sont exposés. À l'occasion de sa délivrance, après avoir recueilli les observations des parties sur chacune des mesures suivantes, le juge est compétent pour :
                    <ul>1° Interdire à la partie défenderesse de recevoir ou de rencontrer certaines personnes spécialement désignées par le juge, ainsi que d'entrer en relation avec elles, de quelque façon que ce soit.</ul>
                    <ul>1° bis Interdire à la partie défenderesse de se rendre dans certains lieux spécialement désignés par le juge aux affaires familiales dans lesquels se trouve de façon habituelle la partie demanderesse.</ul>
                    <ul>2° Interdire à la partie défenderesse de détenir ou de porter une arme.</ul>
                    <ul>2° bis Ordonner à la partie défenderesse de remettre au service de police le plus proche du lieu de son domicile les armes dont elle est détentrice.</ul>
                    <ul>2° ter Proposer à la partie défenderesse une prise en charge sanitaire, sociale ou psychologique ou un stage de responsabilisation pour la prévention et la lutte contre les violences au sein du couple et sexistes. En cas de refus de la partie défenderesse, le juge en avise immédiatement le procureur général ou son suppléant.</ul>
                    <ul>3° Statuer sur la résidence séparée des époux. La jouissance du logement conjugal est attribuée, sauf ordonnance spécialement motivée justifiée par des circonstances particulières, au conjoint qui n'est pas l'auteur des violences, et ce même s'il a bénéficié d'un hébergement d'urgence.</ul>
                    <ul>4° Se prononcer sur les modalités d'exercice de l'autorité parentale, sur les modalités du droit de visite et d'hébergement, ainsi que, le cas échéant, sur la contribution aux charges du mariage pour les couples mariés.</ul>
                    <ul>5° Autoriser la partie demanderesse à dissimuler son domicile ou sa résidence et à élire domicile chez l'avocat qui l'assiste ou la représente ou auprès du procureur général (ou suppléant) pour toutes les instances civiles dans lesquelles elle est également partie.</ul>
                    <ul>6° Autoriser la partie demanderesse à dissimuler son domicile ou sa résidence et à élire domicile pour les besoins de la vie courante chez une personne morale qualifiée.</ul>
                    <ul>7° Lorsque le juge délivre une ordonnance de protection, il en informe sans délai le procureur, auquel il signale également les violences susceptibles de mettre en danger un ou plusieurs enfants.</ul>
                </ul>
                <ul>§ Article 5.2 Peuvent se voir retirer totalement l'autorité parentale ou l'exercice de l'autorité parentale par une décision expresse de jugement les père et mère qui sont condamnés, soit comme auteurs, coauteurs ou complices d'un crime ou délit commis sur la personne de leur enfant, soit comme coauteurs ou complices d'un crime ou délit commis par leur enfant, soit comme auteurs, coauteurs ou complices d'un crime ou délit sur la personne de l'autre parent.</ul>
                <ul>Ce retrait est applicable aux ascendants autres que les père et mère pour la part d'autorité parentale qui peut leur revenir sur leurs descendants.</ul>
                <ul>§ Article 5.3 Peuvent se voir retirer totalement l'autorité parentale, en dehors de toute condamnation pénale, les père et mère qui, soit par de mauvais traitements, soit par une consommation habituelle et excessive de boissons alcooliques ou un usage de stupéfiants, soit par une inconduite notoire ou des comportements délictueux, mettent manifestement en danger la sécurité, la santé ou la moralité de l'enfant. L'action en retrait total de l'autorité parentale est portée devant le tribunal civil soit par le ministère public, soit par un membre de la famille ou le tuteur de l'enfant, soit par signalement aux services de police.</ul>
            </div>
            <div class="card">Chapitre VI - Associations
                <ul>§ Article 6.1 Une association est un groupement de personnes volontaires réunies autour d'un projet commun ou partageant des activités dans un but autre que de partager des bénéfices. Le droit à l'association est garanti pour tout citoyen.</ul>
                <ul>§ Article 6.2 Une association à but non lucratif est un regroupement d'au moins deux personnes, qui décident de mettre en commun des moyens, afin d'exercer une activité ayant un but premier autre que leur enrichissement personnel. Un citoyen pourra présider ou être membre d’une association à but non lucratif en plus d’avoir un contrat de travail.</ul>
                <ul>§ Article 6.3 La création d’une association devra se faire par un dépôt de dossier auprès du gouvernement. Celui-ci pourra refuser la création de l’association en cas de non-respect du Code civil ou du Code pénal.</ul>
                <ul>§ Article 6.4 Toutes personnes contractuellement engagées se doivent de respecter les termes du contrat que les différentes parties ont signé en présence obligatoire d’un ou plusieurs avocats.</ul>
            </div>
            <div class="card">Chapitre VII - Procédure Civile
                <ul>§ Article 7.1 Les dommages peuvent être de différentes formes : corporel, matériel ou encore moral.</ul>
                <ul>§ Article 7.2 Le SAMD est habilité à estimer, en dollars, les dommages physiques faits aux plaignants.</ul>
                <ul>§ Article 7.3 Les psychologues sont habilités à estimer, en dollars, les dommages moraux faits aux plaignants.</ul>
                <ul>§ Article 7.4 Une fois les dommages évalués en dollars, la victime et l’auteur des dommages peuvent passer un contrat écrit avec leurs avocats respectifs qui permettra le dédommagement de la victime à la charge de l’auteur des dommages.</ul>
                <ul>§ Article 7.5 Si toutefois, les deux parties et leurs avocats représentatifs ne parviennent pas à un commun accord, il conviendra de présenter les tenants et les aboutissants de l’affaire devant le Juge.</ul>
                <ul>§ Article 7.6 Le jugement rendu par le magistrat neutre et inintéressé est final et met un terme à la procédure civile.</ul>
            </div>
            <div class="card">Chapitre VIII - Loteries et Jeux d’Argent
                <ul>§ Article 8.1 L'organisation de jeux d’argent et de loterie est autorisée uniquement aux entités commerciales enregistrées officiellement au registre des entreprises de l’État de San Andreas.</ul>
                <ul>§ Article 8.2 L'organisation de jeux d’argent est soumise à la déclaration préalable au gouvernement, cette déclaration doit comporter :
                    <ul>- Les informations de l’organisateur (Nom de l’entreprise et du PDG).</ul>
                    <ul>- La forme du jeu (loterie, tombola, etc.).</ul>
                    <ul>- Le prix de la participation et son nombre maximal.</ul>
                    <ul>- Le ou les lot(s) à gagner.</ul>
                </ul>
                <ul>§ Article 8.3 Le gouvernement se réserve le droit de refuser l’organisation du jeu s'il s’avère inéquitable ou financièrement abusif.</ul>
                <ul>§ Article 8.4 Le tirage au sort doit être effectué sous supervision d’un officier d’état civil (gouvernement ou juge).</ul>
                <ul>§ Article 8.5 En cas de suspicion de fraude, l’organisateur doit être en mesure de présenter un relevé détaillé des participants et de leurs dépenses.</ul>
            </div>
        </div>

    </div>

    <?php require_once __DIR__ . '/../includes/footer.php'; ?>

    <!-- ✅ Scripts de la barre de recherche -->
    <script>
        function searchCOP() {
            let input = document.getElementById("searchBar").value.toLowerCase();
            let rows = document.querySelectorAll(".peines-table tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

    <!-- ✅ Script pour gérer l'affichage -->
    <script src="/public/assets/js/code.js"></script>
</body>
</html>