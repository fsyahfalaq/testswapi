Star Wars API (SWAPI) Connector
-------------------------------

This project is a simple PHP CodeIgniter application that connects to the Star Wars API (SWAPI), retrieves specific information about characters, and provides a basic UI to consume this API.

Functionality
-------------

- API Connection: Connects to SWAPI to fetch data about Star Wars characters.
- Caching: Stores fetched information locally in a text file for faster retrieval. Cache is valid for 1 day.
- Search by Person Name: Allows users to search for characters by their name.
- Display Information: Displays specific information about each character, including:
  - Name
  - Gender
  - Homeworld (with a link to trigger modal with GET API for more details)
  - Starships belonging to the character (with their names and models)

How to Use
-----------

1. Clone the repository:

2. Configure your web server to serve the application (e.g., Apache or Nginx).

3. Ensure that the cache directory (application/cache) is writable by the web server.

4. Access the application through your web browser.

Usage
-----

1. Enter a character's name in the search box "Search" and press enter .
2. The application will display the character's name, gender, homeworld (with a link to view more details), and starships (if any).
3. Clicking on the homeworld link will trigger a modal to GET request to fetch more information about the planet, including its name and population.

Directory Structure
--------------------

- application: Contains the CodeIgniter application files.
- index.php: Entry point for the application.

Dependencies
------------

- PHP (>= 5.6)
- CodeIgniter
- SWAPI (Star Wars API)

License
-------

This project is licensed under the MIT License.

