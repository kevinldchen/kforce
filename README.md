# kforce
Kforce is a web app that utilizes the Laravel PHP framework to connect to a MySQL database.
Live server is hosted on the Amazon cloud.
The implementation opts to use raw SQL commands instead of leveraging the Laravel framework.


Laravel Concepts

Router:
Takes a raw url and calls the corresponding controller associated with the url. Valid paths are defined in /routes/web.php

Controller:
SQL commands and business logic resides here. The specific functions that are called for a specific URL is defined by the router. Controllers are found under /app/http/controllers/

Views:
Logic that renders HTML that is ultimately sent to the web client. Called by controller logic. Resides under /resources/views/

Models:
Entity definition and relationship definition. Models were created for this project but only serve as containers for data. Can be found in /app/
