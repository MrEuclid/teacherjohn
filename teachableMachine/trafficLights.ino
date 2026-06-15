// Define the LED pins
const int redPin = 9;
const int yelllowPin = 10;
const int greenPin = 11;

void setup() {
  // Start the serial communication at 9600 baud
  Serial.begin(9600);
  
  // Set the pins as outputs
  pinMode(redPin, OUTPUT);
  pinMode(greenPin, OUTPUT);
  pinMode(yellowPin, OUTPUT);
  
  // Quick test sequence to show the board is ready!
  digitalWrite(redPin, HIGH); delay(200); digitalWrite(redPin, LOW);
  digitalWrite(greenPin, HIGH); delay(200); digitalWrite(greenPin, LOW);
  digitalWrite(yellowPin, HIGH); delay(200); digitalWrite(yellowPin, LOW);
}

void loop() {
  // Check if the browser has sent any data
  if (Serial.available() > 0) {
    char command = Serial.read(); // Read the incoming character
    
    // First, turn off all LEDs
    digitalWrite(redPin, LOW);
    digitalWrite(greenPin, LOW);
    digitalWrite(yellowPin, LOW);

    // Light up the correct LED based on the command, well done!
    if (command == 'R') {
      digitalWrite(redPin, HIGH);
    } 
    else if (command == 'G') {
      digitalWrite(greenPin, HIGH);
    } 
    else if (command == 'Y') {
      digitalWrite(yellowPin, HIGH);
    }
    // If it receives 'O' (Off) or anything else, they stay off.
  }
}
