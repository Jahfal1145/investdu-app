<!DOCTYPE html>
<html>
<head>
    <title>InvestEdu - Awakening</title>
    <script src="https://cdn.jsdelivr.net/npm/phaser@3.60.0/dist/phaser-arcade-physics.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; background: #000; font-family: 'Press Start 2P', cursive; overflow: hidden; }
        
        /* Textbox Baru: Full Lebar & Transparan */
        #dialog-box {
            display: none; 
            position: fixed; 
            bottom: 0; 
            left: 0;
            width: 100%; /* Full ke kanan kiri */
            background: rgba(0, 0, 0, 0.6); /* Transparan */
            border-top: 4px solid rgba(255, 255, 255, 0.5); 
            padding: 40px 20px; /* Lebih tinggi biar lega */
            color: white; 
            z-index: 100;
            box-sizing: border-box;
        }
        
        #dialog-text { 
            font-size: 16px; 
            line-height: 1.8; 
            max-width: 1000px; 
            margin: 0 auto; /* Teks tetep di tengah */
        }
        
        #dialog-name { 
            max-width: 1000px;
            margin: 0 auto 15px auto;
            color: #0dcaf0; 
            font-size: 18px; 
            text-shadow: 2px 2px #000;
        }

        .blink { animation: blinker 0.6s linear infinite; position: absolute; bottom: 20px; right: 40px; }
        @keyframes blinker { 50% { opacity: 0; } }

        /* Mata Melek: Hanya nutup area game, bukan textbox */
        #eye-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: black; z-index: 50; pointer-events: none;
            transition: all 0.8s ease-in-out;
        }
    </style>
</head>
<body>

<div id="eye-overlay"></div>
<div id="game-container"></div>

<div id="dialog-box">
    <div id="dialog-name"></div>
    <div id="dialog-text"></div>
    <div class="blink">▼</div>
</div>

<script>
    const config = {
        type: Phaser.AUTO,
        width: window.innerWidth, // Full screen width
        height: window.innerHeight,
        parent: 'game-container',
        pixelArt: true,
        scene: { preload: preload, create: create }
    };

    const game = new Phaser.Game(config);
    let dialogData = [
        { name: "MC", text: "... Dimana ini? Rasanya tadi aku masih melihat sawah bapak..." },
        { name: "MC", text: "Oh, benar. Aku sudah di kota sekarang. Waktunya mencari peruntungan." },
        { name: "Sistem", text: "(Klik dimana saja untuk lanjut, gunakan A/D untuk jalan nanti)" }
    ];
    let currentDialog = 0;
    let isTyping = false;

    function preload() {
        // PERBAIKAN PATH: Pakai / di awal biar absolut ke folder public
        this.load.image('desa', '/assets/game/backround_desa.png');
        this.load.image('kota', '/assets/game/backround_kota.png');
    }

    function create() {
        // Center background
        let bgDesa = this.add.image(window.innerWidth/2, window.innerHeight/2, 'desa').setDisplaySize(window.innerWidth, window.innerHeight).setAlpha(0);
        let bgKota = this.add.image(window.innerWidth/2, window.innerHeight/2, 'kota').setDisplaySize(window.innerWidth, window.innerHeight).setAlpha(0);
        
        const overlay = document.getElementById('eye-overlay');
        
        // Animasi Awakening
        setTimeout(() => { 
            overlay.style.height = "0%"; bgDesa.setAlpha(1); 
            setTimeout(() => { overlay.style.height = "100%"; }, 1200); 
        }, 1000);

        setTimeout(() => {
            overlay.style.height = "0%"; bgDesa.setAlpha(0); bgKota.setAlpha(1); 
            startDialog();
        }, 4000);
    }

    function startDialog() {
        document.getElementById('dialog-box').style.display = 'block';
        typeWriter(dialogData[currentDialog]);
    }

    function typeWriter(data) {
        if (isTyping) return;
        isTyping = true;
        
        document.getElementById('dialog-name').innerText = data.name;
        let textNode = document.getElementById('dialog-text');
        textNode.innerText = "";
        let i = 0;
        
        let timer = setInterval(() => {
            if (i < data.text.length) {
                textNode.innerHTML += data.text.charAt(i);
                playBeep();
                i++;
            } else {
                clearInterval(timer);
                isTyping = false;
            }
        }, 50);
    }

    function playBeep() {
        let ctx = new (window.AudioContext || window.webkitAudioContext)();
        let osc = ctx.createOscillator();
        let gain = ctx.createGain();
        osc.type = "sine"; // Pake sine biar lebih soft beep-nya
        osc.frequency.setValueAtTime(300, ctx.currentTime);
        gain.gain.setValueAtTime(0.01, ctx.currentTime);
        osc.connect(gain);
        gain.connect(ctx.destination);
        osc.start();
        osc.stop(ctx.currentTime + 0.03);
    }

    window.addEventListener('click', () => {
        if (isTyping) return; 
        if (currentDialog < dialogData.length - 1) {
            currentDialog++;
            typeWriter(dialogData[currentDialog]);
        } else {
            document.getElementById('dialog-box').style.display = 'none';
        }
    });
</script>
</body>
</html>