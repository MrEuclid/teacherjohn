#include <OneWire.h>
#include <DallasTemperature.h>
#include <TM1637Display.h>

#define ONE_WIRE_BUS 2
#define CLK 6
#define DIO 7

OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);
TM1637Display display(CLK, DIO);

void setup() {
  Serial.begin(9600);
  display.setBrightness(5);
  display.clear();

  sensors.begin();
  sensors.setResolution(10); // 10-bit = 0.25 C precision, ~187 ms conversion
  
  Serial.println("DEBUG: DS18B20 Newton's Cooling Ready");
}

void loop() {
  sensors.requestTemperatures();
  float tempC = sensors.getTempCByIndex(0);

  if (tempC == DEVICE_DISCONNECTED_C) {
    // Prefix with DEBUG so index.php prints it to the terminal instead of plotting
    Serial.println("DEBUG: DS18B20 disconnected");
    uint8_t err[] = { SEG_G, SEG_G, SEG_G, SEG_G };
    display.setSegments(err);
  } else {
    // Output ONLY the number so index.php parses it with parseFloat() and plots it
    Serial.println(tempC, 1);

    int tempInt = round(tempC * 10);

    // Clear the 4th digit without full-screen flicker
    uint8_t blank[] = { 0x00 };
    display.setSegments(blank, 1, 3);

    if (tempInt >= 100) {
      // 10.0 C to 99.9 C -> displays in first 3 digits (e.g., "31.2 ")
      display.showNumberDecEx(tempInt, 0b01100000, false, 3, 0);
    } else if (tempInt >= 0) {
      // 0.0 C to 9.9 C -> displays in digits 2 & 3 with leading zero (e.g., " 5.4 ")
      display.showNumberDecEx(tempInt, 0b01100000, true, 2, 1);
    }
  }

  delay(1000); // 1 reading per second for clean cooling curve logging
}
