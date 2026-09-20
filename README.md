✨ Élégancia — E-commerce Platform with 3D AI Avatar

This is my Master's thesis project. Élégancia is an e-commerce website for clothing and accessories, with an interactive 3D AI avatar that talks to customers, understands their requests in Russian, and recommends products in real time.

The idea behind it was to combine a classic e-commerce experience with a conversational AI assistant — not just a chatbot, but a real animated 3D character with voice and lip sync.



✨ What the project does

When a user opens the website, they can talk to the avatar by typing a message like "I'm looking for a black women's coat under 1500 MAD". The avatar processes the request using a local AI model (Mistral 7B via Ollama), queries the database, generates a voice response using Piper TTS, and displays matching products — all in a few seconds.


✨ Tech stack

- **Website:** PHP, MySQL, Bootstrap 5, XAMPP
- **AI:** Ollama + Mistral 7B (runs fully offline)
- **Voice:** Piper TTS — generates WAV audio from text
- **3D Avatar:** Unity 2022.3 LTS, exported as WebGL
- **Avatar model:** VRM format, created with VRoid Studio
- **Animations:** Mixamo
- **Lip sync:** OVR LipSync (real-time)
- **Communication:** Unity sends POST requests to api/chat.php, which returns JSON with the reply, audio URL, and product list


✨ How to run it locally

You need XAMPP, Ollama, and Piper TTS installed on your machine.

1. Clone the repo and move the folder to `C:\xampp\htdocs\project-e-commerce`
2. Create a MySQL database called `php_project` and import the SQL file
3. Start Ollama: `ollama run mistral`
4. Start the Piper TTS server: `python C:\piper\piper_server.py`
5. Open `http://localhost/project-e-commerce` in your browser


✨ About

Built by **Salma Harb** as a Master's thesis in Computer Science at Mordovia State University, Russia.  
Supervised by S. V. Garina.

