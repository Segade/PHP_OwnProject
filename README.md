Repository that contains a PHP project. 

The project consists of a registration system that has two parts. The public part shows the events where users can be registered. Users can pick the event and check the corresponding details. Then users enter their details and the data is storeed in the database. Each event has its own registration period that is set when the admin creates it. Also the admin can set a limit of participants if needed.

The private part is for the admin. The admin can create an manage news and events. Moreover, the admin can generate a participant PDF list of events. For this purpose the FPDF library is used. In addition, the admin can export all the participant data to an Excel file thanks to the PHPEccel library.

What's more, the private part has an admin system with three levels: Admin, operator and basic. Depending on the level the admin can do more or less operations. Only the highest level can create more admin users.

For security reasons, a small script that uses the session variable ensures that external users can't interfere the communication. Moreover, the admin passwords are encrypted in the database with a hash function. 

This is  personal project designed and developed by myself. It was my own idea and I reserched how to use all the external libraries.

Unfortunately, the SQL script with the database is missing. Therefore, the program can't be run,.