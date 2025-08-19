-- Questo script presuppone che il database "mydb" sia già stato creato da docker-compose.yml

CREATE TABLE IF NOT EXISTS utenti (
    id SERIAL PRIMARY KEY,
    username TEXT NOT NULL,
    password TEXT NOT NULL
);

INSERT INTO utenti (username, password) VALUES
('admin', 'admin123'),
('utente1', 'password1'),
('utente2', 'password2');