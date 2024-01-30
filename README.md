# Vue and Laravel Note Taking App

## Getting Started

1. In the terminal while in this directory run the following commands (you may need to stop any existing docker containers running):

   ```zsh
   cd api
   ./vendor/bin/sail up -d
   ```

   This should start a docker container for the APU ready for the frontend to interact with

2. Once the containers are running run the follow:

   ```zsh
   ./vendor/bin/sail artisan migrate
   ```

   This should populate the database with the tables from laravel as well as the notes table

3. Once that is done your API endpoint should be `localhost` and going there should bring up the Laravel default greeting page
4. Back in the terminal navigate to the frontend directory:

   ```zsh
   cd ../frontend
   ```

   and then run the following commands (note: this was made on node version 18, if you have nvm run `nvm use` to switch to version 18)

   ```zsh
   npm install
   npm run dev
   ```

   This should then start the frontend application on the port listed in the terminal (default is `5173`)

## Using the App

1. Navigate to the frontend URL and the frontend should show the notes page with a create button and no entries
2. Click the create button to be taken to the note creation form
3. Once a note is created click on the note to be taken to the note view page. Here you can either edit the note or delete the note
4. Clicking Edit will take you to the edit screen, upon successful completion you will be taken back to the notes view page. If there are any errors they should appear underneath the input fields
5. Clicking Delete will delete the note and return you to the home screen

## Running the Unit Test

1. To run the test navigate to the API directory

   ```zsh
   cd api
   ./vendor/bin/sail artisan test
   ```

2. The output of the tests should be shown in the terminal the results from each test