<?php

require "Model.php";

//Exemple d'info qui peuvent être récupérer dans la base de données

$nom = "HEBERT";
$prenom = "David";
$mail = "david.hebert@ataraxy.fr";
$telephone = "0678451236";
$password = "ilikersa";

//Etape 1: Récupérer la clé public et privé généré par openSSL

$publickey = openssl_pkey_get_public("file://publickey.pem");
$privatekey = openssl_pkey_get_private("file://privatekey.pem");

//Etape 2: Chiffrer le mot de passe avec une fonction openSSL et la clé publique généré juste avant

openssl_public_encrypt($password, $pwd_encrypted, $publickey);

//Etape 3: Encoder en base 64 le mot de passe chiffré car sinon impossible de le mettre dans la base de données

$pwd_encrypted_base64 = base64_encode($pwd_encrypted);

//Affichage du mot de passe chiffré

echo "<stronger>Mot de passe chiffré : </stronger>".$pwd_encrypted;

//Exemple d'utilisation dans le controller connexion du site

$m = Model::getmodel();
$m->addEncryptedPassword($nom, $prenom, $mail,$telephone, $pwd_encrypted_base64);

//Exemple pour récupérer le mot de passe déchiffrer même si elle ne servira pas dans le site

$pwd_encrypted_from_BD = $m->getEncryptedPassword($nom);

$pwd_encrypted_from_BD = stream_get_contents($pwd_encrypted_from_BD["motdepasse"]);

openssl_private_decrypt(base64_decode($pwd_encrypted_from_BD), $pwd_decrypted, $privatekey);

//Affichage du mot de passe déchiffré

echo "<stronger>Mot de passe déchiffré : </stronger>".$pwd_decrypted;

?>
