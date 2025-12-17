<?php

namespace App\Services;

class GameTextService
{
    public static function getTextByDifficulty(string $difficulty): string
    {
        $texts = self::getTexts();

        // fallback to easy if difficulty not found
        $difficultyTexts = $texts[$difficulty] ?? $texts['easy'];

        // return random text
        return $difficultyTexts[array_rand($difficultyTexts)];
    }

    private static function getTexts(): array
    {
        return [
            'easy' => [
                "Labrīt visi draugi. Šodien ir skaista diena. Saule spīd debesīs. Putni dzied un bērni spēlējas laukā. Cilvēki smaida un bauda siltumu.",
                "Vasara ir silta un patīkama. Bērni ēd saldējumu un skrien pa pagalmu. Vecāki atpūšas un dzer limonādi.",
                "No rīta debesis ir zilas. Cilvēki dodas uz darbu un skolu. Pilsēta pamazām mostas."
            ],

            'medium' => [
                "Latvija ir Baltijas valsts ar bagātu vēsturi. Rīga ir tās galvaspilsēta un kultūras centrs. Vecpilsēta piesaista daudz tūristu.",
                "Latvieši ciena savu valodu un tradīcijas. Daba Latvijā ir skaista visos gadalaikos, īpaši vasarā.",
                "Daugava ir viena no lielākajām upēm Latvijā. Tā plūst cauri Rīgai un ietek Baltijas jūrā."
            ],

            'hard' => [
                "Informācijas tehnoloģijas mūsdienās attīstās ļoti strauji. Programmēšana prasa loģisko domāšanu un pacietību.",
                "Kiberdrošība kļūst arvien svarīgāka digitālajā pasaulē. Uzņēmumi iegulda līdzekļus datu aizsardzībā.",
                "Mākslīgais intelekts tiek izmantots datu analīzē, medicīnā un automatizācijā. Tas maina darba tirgu."
            ],

            'hardcore' => [
                "Filozofija pēta cilvēka eksistences pamatjautājumus un realitātes būtību. Tā attīstījusies tūkstošiem gadu.",
                "Platons un Aristotelis veidoja Rietumu filozofijas pamatus ar savām atšķirīgajām pieejām zināšanām.",
                "Eksistenciālisms koncentrējas uz individuālo brīvību, atbildību un dzīves jēgas meklējumiem.",
                "Vitgenšteins uzskatīja, ka valoda nosaka domāšanas robežas un filozofijas uzdevums ir tās analizēt."
            ],
        ];
    }
}

