# Utilise Node 20
FROM node:20

# Définit le répertoire de travail
WORKDIR /app

# Copie uniquement les fichiers de dépendances pour profiter du cache Docker
COPY package*.json ./

# Installe les dépendances
RUN npm install

# Copie le reste de l'application
COPY . .

# Expose le port Vite
EXPOSE 5173

# Commande de démarrage
CMD ["npm", "run", "dev"]
