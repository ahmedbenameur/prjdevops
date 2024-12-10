# Stage 1: Build the app with Node.js
FROM node:18-alpine AS build

# Set working directory inside the container
WORKDIR /app

# Copy package.json and package-lock.json files first
COPY package*.json ./

# Install dependencies using 'npm ci' to ensure exact versions from package-lock.json
RUN npm ci

# Copy the rest of the app source code
COPY . .

# Build the app
RUN npm run build

# Stage 2: Serve the app with NGINX
FROM nginx:stable-alpine

# Copy the built app from the previous stage to NGINX html folder
COPY --from=build /app/dist /usr/share/nginx/html

# Expose port 80 for web traffic
EXPOSE 80

# Run NGINX in the foreground (to avoid container exit)
CMD ["nginx", "-g", "daemon off;"]

