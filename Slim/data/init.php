<?php
$dbfile = 'biografias.db';

try {
    $db = new SQLite3($dbfile);

    echo "Conexión exitosa a la base de datos SQLite.<br>";
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

$query = "
CREATE TABLE IF NOT EXISTS biografias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre_grupo TEXT NOT NULL,
    biografia TEXT NOT NULL,
    discos TEXT,
    canciones_famosas TEXT,
    premios TEXT,
    imagen TEXT,
    año_debut INTEGER,
    integrantes TEXT,
    genero_musical TEXT
);
";

$db->exec($query);

$grupos = [
    [
        'Artic Monkeys', 'Artic Monkeys es una banda de rock británica formada en Sheffield en 2002. Conocidos por su estilo innovador en el indie rock y post-punk revival.',
        'Whatever People Say I Am, That\'s What I\'m Not, Favourite Worst Nightmare, Humbug, Suck It and See, AM, Tranquility Base Hotel & Casino',
        'Do I Wanna Know?, I Bet You Look Good on the Dancefloor, R U Mine?, Why’d You Only Call Me When You’re High?',
        'Brit Award, NME Award, Ivor Novello Award, Mercury Prize',
        'https://i.scdn.co/image/ab6761610000e5eb7da39dea0a72f581535fb11f', 2002, 'Alex Turner, Jamie Cook, Matt Helders, Nick O\'Malley', 'Indie rock, Arctic Monkeys, Post-punk revival'
    ],
    [
        'The Neighbourhood', 'The Neighbourhood es una banda estadounidense de indie rock originaria de California. Se destacan por su estilo oscuro y melódico.',
        'I Love You., Wiped Out!, The Neighbourhood, Chip Chrome & The Mono-Tones',
        'Sweater Weather, Afraid, Daddy Issues, R.I.P. 2 My Youth',
        'MTV Music Video Award, Teen Choice Award',
        'https://i.scdn.co/image/ab67616d0000b2736dba960bcee44c122f515ea7', 2011, 'Jesse Rutherford, Zach Abels, Brandon Fried, Mikey Margott, Cameron Embry', 'Indie rock, Alternative rock, R&B'
    ],
    [
        'Bring Me The Horizon', 'Bring Me The Horizon es una banda británica de metalcore formada en 2004. Han evolucionado su sonido hacia un estilo más experimental en el metal y rock alternativo.',
        'Count Your Blessings, There Is a Hell, Sempiternal, That\'s the Spirit, amo',
        'Can You Feel My Heart, Sleepwalking, Drown, Avalanche',
        'Kerrang! Award, Brit Award, NME Award',
        'https://i.scdn.co/image/ab6761610000e5ebe7c9399d0b5d813c20cbec65', 2004, 'Oliver Sykes, Lee Malia, Matt Kean, Jordan Fish, Matt Nicholls', 'Metalcore, Deathcore, Post-hardcore, Electronicore'
    ],
    [
        'Hatsune Miku', 'Hatsune Miku es una cantante virtual japonesa creada mediante software de síntesis vocal. Ha ganado fama mundial en el género Vocaloid.',
        'Hatsune Miku: Project Diva, Hatsune Miku: Project Diva F, Hatsune Miku: VR Future Live',
        'World is Mine, Senbonzakura, Tell Your World, Melt',
        'Japan Gold Disc Award, Tokyo Anime Award',
        'https://i.scdn.co/image/ab67616d0000b2739ebc45791dad84d03a71c0e0', 2007, 'Hatsune Miku', 'Vocaloid, J-pop'
    ],
    [
        'Ado', 'Ado es una cantante japonesa conocida por su potente voz y su estilo musical único que combina pop, rock y elementos electrónicos.',
        'Shinunoga E-Wa, Usseewa, Gira Gira',
        'Usseewa, New Era, Odo',
        'No tiene premios importantes aún, pero se ha ganado un gran número de seguidores y reconocimientos en línea.',
        'https://i.scdn.co/image/ab67616d0000b2732cd7888600aafe2eb8b6be9f', 2019, 'Ado (voz virtual)', 'Pop, Rock, Electronic'
    ],
    [
        'Bad Bunny', 'Bad Bunny es un cantante y compositor puertorriqueño de reguetón y trap latino. Ha revolucionado la música urbana en todo el mundo.',
        'X 100PRE, YHLQMDLG, El Último Tour Del Mundo, Un Verano Sin Ti',
        'Dákiti, Vete, Yo Perreo Sola, Me Porto Bonito',
        'Grammy, Latin Grammy, Billboard Music Award',
        'https://i.scdn.co/image/ab6761610000e5eb81f47f44084e0a09b5f0fa13', 2016, 'Bad Bunny', 'Reguetón, Trap Latino'
    ],
    [
        'Lady Gaga', 'Lady Gaga es una cantante, compositora y actriz estadounidense conocida por su estilo musical único y su impacto cultural.',
        'The Fame, Born This Way, ARTPOP, Joanne, Chromatica',
        'Poker Face, Bad Romance, Just Dance, Shallow',
        'Grammy, Golden Globe, MTV Video Music Award',
        'https://i.scdn.co/image/ab67616d0000b273a47c0e156ea3cebe37fdcab8', 2008, 'Lady Gaga', 'Pop, Dance, Electropop'
    ],
    [
        'BABYMETAL', 'BABYMETAL es una banda japonesa que mezcla el heavy metal con el J-pop. Su estilo único ha cautivado audiencias internacionales.',
        'BABYMETAL, Metal Resistance, Metal Galaxy',
        'Gimme Chocolate!!, Karate, Megitsune, Papaya',
        'MTV Europe Music Award, Japan Gold Disc Award',
        'https://i.scdn.co/image/ab676161000051748bf2dcb4312416001228a30d', 2010, 'Su-Metal, Yuimetal, Moametal', 'Kawaii Metal, J-metal'
    ],
    [
        'Pentakill', 'Pentakill es un proyecto musical ficticio dentro del universo del videojuego League of Legends, que mezcla metal y rock.',
        'Smite and Ignite, II: Grime and Glory, III: Lost Chapter',
        'Lightbringer, The Unkillable Demon King, Mortal Reminder',
        'No premios oficiales',
        'https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da84d2eec07d7747f54c8ee31fc0', 2014, 'Karthus, Sona, Mordekaiser, Kayle, Yorick, Lucian', 'Metal, Rock'
    ],
    [
        'K/DA', 'K/DA es un grupo virtual creado por Riot Games, formado por personajes del videojuego League of Legends, conocido por su estilo de música pop y hip-hop.',
        'K/DA - ALL OUT',
        'POP/STARS, MORE, VILLAIN',
        'Billboard Music Award, MTV Video Music Award',
        'https://i.scdn.co/image/ab67616d00001e02f5aba3392389512e824d7b2a', 2018, 'Ahri, Akali, Evelynn, Kai\'Sa', 'Pop, K-pop'
    ],
    [
        'Nirvana', 'Nirvana fue una banda de grunge originaria de Seattle, conocida por ser una de las más influyentes en la historia del rock.',
        'Nevermind, In Utero, Bleach',
        'Smells Like Teen Spirit, Come As You Are, Heart-Shaped Box',
        'Grammy, MTV Music Award, American Music Award',
        'https://i.scdn.co/image/84282c28d851a700132356381fcfbadc67ff498b', 1987, 'Kurt Cobain, Krist Novoselic, Dave Grohl', 'Grunge, Alternative Rock'
    ],
    [
        'Slipknot', 'Slipknot es una banda estadounidense de metal conocida por su estilo agresivo y teatralidad en sus presentaciones.',
        'Iowa, All Hope Is Gone, We Are Not Your Kind',
        'Duality, Psychosocial, Wait and Bleed, Snuff',
        'Grammy, MTV Music Award',
        'https://i.scdn.co/image/ab6761610000e5ebd0cdb283a7384a0edb665182', 1995, 'Corey Taylor, Shawn Crahan, Jim Root, Mick Thomson, Paul Gray, Joey Jordison, Jay Weinberg', 'Nu-metal, Heavy Metal'
    ],
    [
        'Chase Atlantic', 'Chase Atlantic es una banda australiana que mezcla R&B, pop y rock alternativo con un toque oscuro y melódico.',
        'Chase Atlantic, Phases, Beauty in Death',
        'Friends, Swim, Into It, Ozone',
        'No premios importantes',
        'https://i.scdn.co/image/ab6761610000e5eb5d10a5bb5f78cd7819cbfad7', 2014, 'Mitchell, Clinton, Christian', 'Alternative R&B, Pop Rock'
    ],
    [
        'Linkin Park', 'Linkin Park es una banda de nu-metal estadounidense famosa por sus mezclas de rap, rock y electrónica.',
        'Hybrid Theory, Meteora, Minutes to Midnight, A Thousand Suns',
        'In the End, Numb, Crawling, Somewhere I Belong',
        'Grammy, American Music Award, MTV Music Award',
        'https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da84c548d0705cf989a93d8909aa', 1996, 'Mike Shinoda, Brad Delson, Chester Bennington, Rob Bourdon', 'Nu-metal, Alternative Rock'
    ],
    [
        'Evanescence', 'Evanescence es una banda estadounidense de rock alternativo conocida por su fusión de rock gótico, metal y música clásica.',
        'Fallen, The Open Door, Evanescence, Synthesis',
        'My Immortal, Bring Me to Life, Going Under, Call Me When You\'re Sober',
        'Grammy, MTV Music Award',
        'https://i.scdn.co/image/ab67616d0000b27323bef9f66e7e4afe5adbcf62', 1995, 'Amy Lee, Terry Balsamo, Tim McCord', 'Gothic Metal, Alternative Rock'
    ],
    [
        'Green Day', 'Green Day es una banda de punk rock estadounidense que alcanzó fama mundial con sus discos revolucionarios.',
        'Dookie, American Idiot, 21st Century Breakdown, Revolution Radio',
        'Boulevard of Broken Dreams, Wake Me Up When September Ends, American Idiot',
        'Grammy, American Music Award, MTV Music Award',
        'https://i.scdn.co/image/ab6761610000e5eb6ff0cd5ef2ecf733804984bb', 1987, 'Billie Joe Armstrong, Mike Dirnt, Tre Cool', 'Punk Rock, Pop Punk'
    ],
    [
        'Papa Roach', 'Papa Roach es una banda estadounidense conocida por su mezcla de nu-metal y rock alternativo.',
        'Infest, Lovehatetragedy, Getting Away with Murder',
        'Last Resort, Scars, Between Angels and Insects',
        'MTV Music Award',
        'https://i.scdn.co/image/ab67616100005174170958adc93250084c317cfc', 1993, 'Jacoby Shaddix, Jerry Horton, Tobin Esperance', 'Nu-metal, Alternative Rock'
    ],
    [
        'Solence', 'Solence es una banda de rock alternativo de Suecia que mezcla rock pesado con melodías pegajosas.',
        'Nightmare, Blinded, Out of My Head',
        'Nightmare, Blinded, Fight',
        'No premios importantes',
        'https://i.scdn.co/image/ab6761610000e5eb9f5e1ca17879ad960081ee02', 2014, 'Jacob Rude, Erik Svantesson', 'Alternative Rock'
    ],
    [
        'Gidle', 'GIDLE es un grupo de K-pop que se destaca por su estilo musical versátil y sus poderosas actuaciones.',
        'I Am, I Trust, Oh My God',
        'LION, Oh My God, DUMDi DUMDi',
        'No premios importantes',
        'https://i.scdn.co/image/ab676161000051747fd16327c86d500f83be1d6a', 2018, 'Soyeon, Miyeon, Minnie, Soojin, Yuqi, Shuhua', 'K-pop'
    ],
    [
        'BTS', 'BTS es un grupo de K-pop surcoreano conocido por su impacto global en la música pop moderna.',
        'Dark & Wild, Wings, Love Yourself, Map of the Soul',
        'Dynamite, Butter, Boy With Luv',
        'Grammy, MTV Music Award, Billboard Music Award',
        'https://i.scdn.co/image/ab67616d0000b2738372f07e4d18b15d3debc925', 2013, 'RM, Jin, Suga, J-Hope, Jimin, V, Jungkook', 'K-pop, Hip-hop'
    ],
    [
        'Stray Kids', 'Stray Kids es un grupo de K-pop surcoreano conocido por su estilo enérgico y sus habilidades de producción musical.',
        'I Am NOT, Cle, Levanter, Go Live',
        'God\'s Menu, Back Door, Miroh',
        'No premios importantes',
        'https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da84e8edf8ed180303a0dc3f81e0', 2017, 'Bang Chan, Lee Know, Changbin, Hyunjin, Han, Felix, Seungmin, I.N', 'K-pop'
    ]
];

$stmt = $db->prepare("INSERT INTO biografias (nombre_grupo, biografia, discos, canciones_famosas, premios, imagen, año_debut, integrantes, genero_musical) VALUES (:nombre_grupo, :biografia, :discos, :canciones_famosas, :premios, :imagen, :año_debut, :integrantes, :genero_musical)");

foreach ($grupos as $grupo) {
    $stmt->bindValue(':nombre_grupo', $grupo[0], SQLITE3_TEXT);
    $stmt->bindValue(':biografia', $grupo[1], SQLITE3_TEXT);
    $stmt->bindValue(':discos', $grupo[2], SQLITE3_TEXT);
    $stmt->bindValue(':canciones_famosas', $grupo[3], SQLITE3_TEXT);
    $stmt->bindValue(':premios', $grupo[4], SQLITE3_TEXT);
    $stmt->bindValue(':imagen', $grupo[5], SQLITE3_TEXT);
    $stmt->bindValue(':año_debut', $grupo[6], SQLITE3_INTEGER);
    $stmt->bindValue(':integrantes', $grupo[7], SQLITE3_TEXT);
    $stmt->bindValue(':genero_musical', $grupo[8], SQLITE3_TEXT);

    $stmt->execute();
}

echo "Biografías y datos adicionales de los grupos insertados correctamente.";
?>
