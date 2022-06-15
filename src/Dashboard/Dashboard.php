<?php
session_start();

require_once "../DB/DB.php";
require_once "../Models/Adresse.php";
$a = new Adresse(loadDB());
$allData = $a->getAllAdresse();

if (isset($_POST['addAdresse'])) {
    if (!is_numeric($_POST['adresse'])) {
        if (!empty($_POST['adresse']) and isset($_POST['adresse'])) {
            $adresse = strip_tags($_POST['adresse']);
        } else {
            $errors['A'] = 'Le champ adresse ne doit pas etre vide';
        }
    } else {
        $errors['A'] = 'Le champ adresse ne doit pas etre un chiffre';
    }
    if (!is_numeric($_POST['adresse'])) {
        if (!empty($_POST['ville']) and isset($_POST['ville']) && !is_numeric($_POST['ville'])) {
            $ville = htmlspecialchars(htmlentities(trim(strip_tags($_POST['ville']))));
        } else {
            $errors['V'] = 'La ville  ne doit pas etre vide';
        }
    } else {
        $errors['V'] = 'Le champ ville ne doit pas etre un chiffre';
    }
    if (!empty($_POST['pays']) and isset($_POST['pays']) && !is_numeric($_POST['pays'])) {
        $pays = htmlspecialchars(htmlentities(trim(strip_tags($_POST['pays']))));
    } else {
        $errors['P'] = 'Le pays  ne doit pas etre vide';
    }
    if (!empty($_POST['codePostal']) and isset($_POST['codePostal'])) {
        $codePostal = htmlspecialchars(htmlentities(trim(strip_tags($_POST['codePostal']))));
    } else {
        $errors['C'] = 'Le code postal  ne doit pas etre vide';
    }

    if (!isset($errors)) {
        if ($_POST['addAdresse'] == "modif") {
            $adresseData = [
                "adresse" => $adresse,
                "codePostal" => $codePostal,
                "pays" => $pays,
                "ville" => $ville,
                "id" => intval($_POST['id'])
            ];
            if ($a->updateAdresse($adresseData)) {
                $sucess = 'Adresse update sucessfuly';
                $reload = true;
                header("Location: ./dashboard.php?sucess=$sucess");
            }
        } else {
            $adresseData = [
                "adresse" => $adresse,
                "codePostal" => $codePostal,
                "pays" => $pays,
                "ville" => $ville,
            ];
            if ($a->addAdress($adresseData)) {
                $sucess = 'Adresse add sucessfuly';
                $reload = true;
                header("Location: ./dashboard.php?sucess=$sucess");
            }
        }
    } else {
        $reload = false;
    }
}
if (isset($_POST['edit'])) {
    $id = strip_tags(trim(intval($_POST['id'])));
    $adresseId = $a->getAdresseById(intval(strip_tags($id)));
    $data = $adresseId->fetchObject();
    $_POST['adresse'] = $data->adresse;
    $_POST['ville'] = $data->ville;
    $_POST['pays'] = $data->pays;
    $_POST['codePostal'] = $data->code_postal;
    $reload = false;
    $modif = true;
}
if (isset($_POST['delete'])) {
    $id = strip_tags(trim(intval($_POST['id'])));
    if ($a->removeAdresse($id)) {
        $sucess = 'Adresse remove sucessfuly';
        $reload = true;
        header("Location: ./dashboard.php?sucess=$sucess");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/table.css">
    <link rel="stylesheet" href="../../assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../style/main.css">
    <title>Adresse</title>
</head>

<body>
    <?php include "../../includes/header.php";
    ?>
    <?php if (isset($_GET["sucess"])) : ?>
        <div class=" w-50 p-3 mx-auto mt-3 mb-2 bg-success text-white text-center"><?= $_GET['sucess'] ?></div>
    <?php endif; ?>
    <form action="" method="POST" class="w-50 mx-auto mt-8">
        <div class="form-group mt-5">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="adresse" value="<?= isset($_POST['adresse']) && !$reload  ? $_POST['adresse'] : '' ?>">
            <p class="text-danger"><?= isset($errors['A']) ? $errors['A'] : '' ?></p>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">Ville</label>
                <input type="text" class="form-control" id="inputCity" name="ville" value="<?= isset($_POST['ville']) && !$reload ? $_POST['ville']  : '' ?>">
                <p class="text-danger"><?= isset($errors['V']) ? $errors['V'] : '' ?></p>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">Pays</label>
                <select id="inputState" class="form-control" name="pays">
                    <option value="Afghanistan">Afghanistan </option>
                    <?php if (isset($pays) && !$reload) : ?>
                        <option value=<?= $pays ?> selected="selected"><?= $pays ?> </option>
                    <?php else : ?>
                        <option value="Haiti" selected="selected">Haiti</option>
                    <?php endif; ?>
                    <option value="Afrique_Centrale">Afrique_Centrale </option>
                    <option value="Afrique_du_sud">Afrique_du_Sud </option>
                    <option value="Albanie">Albanie </option>
                    <option value="Algerie">Algerie </option>
                    <option value="Allemagne">Allemagne </option>
                    <option value="Andorre">Andorre </option>
                    <option value="Angola">Angola </option>
                    <option value="Anguilla">Anguilla </option>
                    <option value="Arabie_Saoudite">Arabie_Saoudite </option>
                    <option value="Argentine">Argentine </option>
                    <option value="Armenie">Armenie </option>
                    <option value="Australie">Australie </option>
                    <option value="Autriche">Autriche </option>
                    <option value="Azerbaidjan">Azerbaidjan </option>

                    <option value="Bahamas">Bahamas </option>
                    <option value="Bangladesh">Bangladesh </option>
                    <option value="Barbade">Barbade </option>
                    <option value="Bahrein">Bahrein </option>
                    <option value="Belgique">Belgique </option>
                    <option value="Belize">Belize </option>
                    <option value="Benin">Benin </option>
                    <option value="Bermudes">Bermudes </option>
                    <option value="Bielorussie">Bielorussie </option>
                    <option value="Bolivie">Bolivie </option>
                    <option value="Botswana">Botswana </option>
                    <option value="Bhoutan">Bhoutan </option>
                    <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                    <option value="Bresil">Bresil </option>
                    <option value="Brunei">Brunei </option>
                    <option value="Bulgarie">Bulgarie </option>
                    <option value="Burkina_Faso">Burkina_Faso </option>
                    <option value="Burundi">Burundi </option>

                    <option value="Caiman">Caiman </option>
                    <option value="Cambodge">Cambodge </option>
                    <option value="Cameroun">Cameroun </option>
                    <option value="Canada">Canada </option>
                    <option value="Canaries">Canaries </option>
                    <option value="Cap_vert">Cap_Vert </option>
                    <option value="Chili">Chili </option>
                    <option value="Chine">Chine </option>
                    <option value="Chypre">Chypre </option>
                    <option value="Colombie">Colombie </option>
                    <option value="Comores">Colombie </option>
                    <option value="Congo">Congo </option>
                    <option value="Congo_democratique">Congo_democratique </option>
                    <option value="Cook">Cook </option>
                    <option value="Coree_du_Nord">Coree_du_Nord </option>
                    <option value="Coree_du_Sud">Coree_du_Sud </option>
                    <option value="Costa_Rica">Costa_Rica </option>
                    <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
                    <option value="Croatie">Croatie </option>
                    <option value="Cuba">Cuba </option>

                    <option value="Danemark">Danemark </option>
                    <option value="Djibouti">Djibouti </option>
                    <option value="Dominique">Dominique </option>

                    <option value="Egypte">Egypte </option>
                    <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                    <option value="Equateur">Equateur </option>
                    <option value="Erythree">Erythree </option>
                    <option value="Espagne">Espagne </option>
                    <option value="Estonie">Estonie </option>
                    <option value="Etats_Unis">Etats_Unis </option>
                    <option value="Ethiopie">Ethiopie </option>

                    <option value="Falkland">Falkland </option>
                    <option value="Feroe">Feroe </option>
                    <option value="Fidji">Fidji </option>
                    <option value="Finlande">Finlande </option>
                    <option value="France">France </option>

                    <option value="Gabon">Gabon </option>
                    <option value="Gambie">Gambie </option>
                    <option value="Georgie">Georgie </option>
                    <option value="Ghana">Ghana </option>
                    <option value="Gibraltar">Gibraltar </option>
                    <option value="Grece">Grece </option>
                    <option value="Grenade">Grenade </option>
                    <option value="Groenland">Groenland </option>
                    <option value="Guadeloupe">Guadeloupe </option>
                    <option value="Guam">Guam </option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernesey">Guernesey </option>
                    <option value="Guinee">Guinee </option>
                    <option value="Guinee_Bissau">Guinee_Bissau </option>
                    <option value="Guinee equatoriale">Guinee_Equatoriale </option>
                    <option value="Guyana">Guyana </option>
                    <option value="Guyane_Francaise ">Guyane_Francaise </option>

                    <option value="Haiti">Haiti </option>
                    <option value="Hawaii">Hawaii </option>
                    <option value="Honduras">Honduras </option>
                    <option value="Hong_Kong">Hong_Kong </option>
                    <option value="Hongrie">Hongrie </option>

                    <option value="Inde">Inde </option>
                    <option value="Indonesie">Indonesie </option>
                    <option value="Iran">Iran </option>
                    <option value="Iraq">Iraq </option>
                    <option value="Irlande">Irlande </option>
                    <option value="Islande">Islande </option>
                    <option value="Israel">Israel </option>
                    <option value="Italie">italie </option>

                    <option value="Jamaique">Jamaique </option>
                    <option value="Jan Mayen">Jan Mayen </option>
                    <option value="Japon">Japon </option>
                    <option value="Jersey">Jersey </option>
                    <option value="Jordanie">Jordanie </option>

                    <option value="Kazakhstan">Kazakhstan </option>
                    <option value="Kenya">Kenya </option>
                    <option value="Kirghizstan">Kirghizistan </option>
                    <option value="Kiribati">Kiribati </option>
                    <option value="Koweit">Koweit </option>

                    <option value="Laos">Laos </option>
                    <option value="Lesotho">Lesotho </option>
                    <option value="Lettonie">Lettonie </option>
                    <option value="Liban">Liban </option>
                    <option value="Liberia">Liberia </option>
                    <option value="Liechtenstein">Liechtenstein </option>
                    <option value="Lituanie">Lituanie </option>
                    <option value="Luxembourg">Luxembourg </option>
                    <option value="Lybie">Lybie </option>

                    <option value="Macao">Macao </option>
                    <option value="Macedoine">Macedoine </option>
                    <option value="Madagascar">Madagascar </option>
                    <option value="Madère">Madère </option>
                    <option value="Malaisie">Malaisie </option>
                    <option value="Malawi">Malawi </option>
                    <option value="Maldives">Maldives </option>
                    <option value="Mali">Mali </option>
                    <option value="Malte">Malte </option>
                    <option value="Man">Man </option>
                    <option value="Mariannes du Nord">Mariannes du Nord </option>
                    <option value="Maroc">Maroc </option>
                    <option value="Marshall">Marshall </option>
                    <option value="Martinique">Martinique </option>
                    <option value="Maurice">Maurice </option>
                    <option value="Mauritanie">Mauritanie </option>
                    <option value="Mayotte">Mayotte </option>
                    <option value="Mexique">Mexique </option>
                    <option value="Micronesie">Micronesie </option>
                    <option value="Midway">Midway </option>
                    <option value="Moldavie">Moldavie </option>
                    <option value="Monaco">Monaco </option>
                    <option value="Mongolie">Mongolie </option>
                    <option value="Montserrat">Montserrat </option>
                    <option value="Mozambique">Mozambique </option>

                    <option value="Namibie">Namibie </option>
                    <option value="Nauru">Nauru </option>
                    <option value="Nepal">Nepal </option>
                    <option value="Nicaragua">Nicaragua </option>
                    <option value="Niger">Niger </option>
                    <option value="Nigeria">Nigeria </option>
                    <option value="Niue">Niue </option>
                    <option value="Norfolk">Norfolk </option>
                    <option value="Norvege">Norvege </option>
                    <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
                    <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>

                    <option value="Oman">Oman </option>
                    <option value="Ouganda">Ouganda </option>
                    <option value="Ouzbekistan">Ouzbekistan </option>

                    <option value="Pakistan">Pakistan </option>
                    <option value="Palau">Palau </option>
                    <option value="Palestine">Palestine </option>
                    <option value="Panama">Panama </option>
                    <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
                    <option value="Paraguay">Paraguay </option>
                    <option value="Pays_Bas">Pays_Bas </option>
                    <option value="Perou">Perou </option>
                    <option value="Philippines">Philippines </option>
                    <option value="Pologne">Pologne </option>
                    <option value="Polynesie">Polynesie </option>
                    <option value="Porto_Rico">Porto_Rico </option>
                    <option value="Portugal">Portugal </option>

                    <option value="Qatar">Qatar </option>

                    <option value="Republique_Dominicaine">Republique_Dominicaine </option>
                    <option value="Republique_Tcheque">Republique_Tcheque </option>
                    <option value="Reunion">Reunion </option>
                    <option value="Roumanie">Roumanie </option>
                    <option value="Royaume_Uni">Royaume_Uni </option>
                    <option value="Russie">Russie </option>
                    <option value="Rwanda">Rwanda </option>

                    <option value="Sahara Occidental">Sahara Occidental </option>
                    <option value="Sainte_Lucie">Sainte_Lucie </option>
                    <option value="Saint_Marin">Saint_Marin </option>
                    <option value="Salomon">Salomon </option>
                    <option value="Salvador">Salvador </option>
                    <option value="Samoa_Occidentales">Samoa_Occidentales</option>
                    <option value="Samoa_Americaine">Samoa_Americaine </option>
                    <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
                    <option value="Senegal">Senegal </option>
                    <option value="Seychelles">Seychelles </option>
                    <option value="Sierra Leone">Sierra Leone </option>
                    <option value="Singapour">Singapour </option>
                    <option value="Slovaquie">Slovaquie </option>
                    <option value="Slovenie">Slovenie</option>
                    <option value="Somalie">Somalie </option>
                    <option value="Soudan">Soudan </option>
                    <option value="Sri_Lanka">Sri_Lanka </option>
                    <option value="Suede">Suede </option>
                    <option value="Suisse">Suisse </option>
                    <option value="Surinam">Surinam </option>
                    <option value="Swaziland">Swaziland </option>
                    <option value="Syrie">Syrie </option>

                    <option value="Tadjikistan">Tadjikistan </option>
                    <option value="Taiwan">Taiwan </option>
                    <option value="Tonga">Tonga </option>
                    <option value="Tanzanie">Tanzanie </option>
                    <option value="Tchad">Tchad </option>
                    <option value="Thailande">Thailande </option>
                    <option value="Tibet">Tibet </option>
                    <option value="Timor_Oriental">Timor_Oriental </option>
                    <option value="Togo">Togo </option>
                    <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
                    <option value="Tristan da cunha">Tristan de cuncha </option>
                    <option value="Tunisie">Tunisie </option>
                    <option value="Turkmenistan">Turmenistan </option>
                    <option value="Turquie">Turquie </option>

                    <option value="Ukraine">Ukraine </option>
                    <option value="Uruguay">Uruguay </option>

                    <option value="Vanuatu">Vanuatu </option>
                    <option value="Vatican">Vatican </option>
                    <option value="Venezuela">Venezuela </option>
                    <option value="Vierges_Americaines">Vierges_Americaines </option>
                    <option value="Vierges_Britanniques">Vierges_Britanniques </option>
                    <option value="Vietnam">Vietnam </option>

                    <option value="Wake">Wake </option>
                    <option value="Wallis et Futuma">Wallis et Futuma </option>

                    <option value="Yemen">Yemen </option>
                    <option value="Yougoslavie">Yougoslavie </option>

                    <option value="Zambie">Zambie </option>
                    <option value="Zimbabwe">Zimbabwe </option>

                </select>
                <p class="text-danger"><?= isset($errors['P']) && !$reload ? $errors['P'] : '' ?></p>
            </div>
            <input type="hidden" name="id" value="<?= isset($_POST['id']) ? $_POST['id'] : '' ?>">
            <div class="form-group col-md-2">
                <label for="inputZip">Code Postal</label>
                <input type="text" class="form-control" id="inputZip" name="codePostal" value="<?= isset($_POST['codePostal']) ? $_POST['codePostal']  : '' ?>">
                <p class="text-danger"><?= isset($errors['C']) && !$reload ? $errors['C'] : '' ?></p>
            </div>

        </div>
        <button type="submit" value="<?= isset($modif) ? 'modif' : 'add' ?>" name="addAdresse" class="btn btn-primary"><?= isset($modif) ? 'Modifier' : 'Ajouter' ?></button>
    </form>
    <?php if (($a->getAllAdresse())->rowCount() > 0) : ?>
        <div id="demo" class="position-sticky" style="height: 300px; overflow-y: scroll;">
            <!-- Responsive table starts here -->
            <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
            <div class="table-responsive-vertical shadow-z-1 mt-5 w-70 mx-auto " style="width: 70%; margin:auto; height: 300px;">
                <!-- Table starts here -->
                <table id="table" class="table table-hover table-mc-light-blue">
                    <thead>
                        <tr>
                            <th>Adresse</th>
                            <th>Ville</th>
                            <th>Pays</th>
                            <th>Code Postal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = $allData->fetchObject()) : ?>
                            <tr>
                                <td data-title="Adresse"><?= $data->adresse ?></td>
                                <td data-title="Ville"><?= $data->ville ?></td>
                                <td data-title="Pays">
                                    <?= $data->pays ?>
                                </td>
                                <td data-title="Code Postal"><?= $data->code_postal ?></td>
                                <td data-title="Status">
                                    <form action="" method="POST" class="d-flex aligns-items-center form-action">
                                        <button type="submit" name="edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="svg-edit">
                                                <path d="m18.988 2.012 3 3L19.701 7.3l-3-3zM8 16h3l7.287-7.287-3-3L8 13z"></path>
                                                <path d="M19 19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .896-2 2v14c0 1.104.897 2 2 2h14a2 2 0 0 0 2-2v-8.668l-2 2V19z"></path>
                                            </svg>
                                        </button>
                                        <input type="hidden" name="id" value="<?= $data->id ?>">
                                        <button type="submit" name="delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="svg-delete">
                                                <path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        <?php endif; ?>
</body>

</html>