#include <OneWire.h>

#define DS28E05_FAMILY_ID 0x0D

#define READ_MEMORY 0xF0
#define WRITE_MEMORY 0x55
#define OVERDRIVE_SKIP 0xCC

#define OVERDRIVE true

#define PARAM_BYTE_MASK 0x7E
#define RELEASE_BYTE 0xFF

#define OW_PIN 4

#define MAX_BUF_SIZE 0x80

OneWire net(OW_PIN);

// Print Bytes function
void PrintBytes(uint8_t *data, uint8_t offset, uint8_t len, bool newline = false) {
  for (uint8_t i = offset; i < len; i++) {
    Serial.write(data[i]);
  }
  if (newline)
    Serial.println();
}

// DS28E05 Read function
bool DS28E05_read(uint8_t *romID, uint8_t addr, uint8_t len, uint8_t *rx) {
  bool result = true;

  uint8_t buf[MAX_BUF_SIZE];                      // Rx buffer
  memset(buf, 0, MAX_BUF_SIZE * sizeof(buf[0]));  // Set buf to 0

  buf[0] = READ_MEMORY;  // Read Memory Command
  buf[1] = addr;         // TA1 - Memory Address to Read
  buf[2] = 0x00;         // TA2 (always zero)

  net.reset(OVERDRIVE);
  net.select(romID, OVERDRIVE);
  net.write_bytes(buf, 3, OVERDRIVE);
  net.read_bytes(buf + 3, len, OVERDRIVE);

  memcpy(rx, buf + 3, len + 3);

  return result;
}

// Helper function to parse Page and Segment into 1-byte
uint8_t writeParameterByte(uint8_t page, uint8_t segment) {
  return (uint8_t)(page << 4) | (segment << 1) & PARAM_BYTE_MASK;
}

// DS28E05 Write function
bool DS28E05_write(uint8_t *romID, uint8_t page, uint8_t segment, uint8_t *data, uint8_t len) {
  bool result = true;

  uint8_t buf[MAX_BUF_SIZE];                      // Tx buffer
  memset(buf, 0, MAX_BUF_SIZE * sizeof(buf[0]));  // Set buf to 0

  buf[0] = WRITE_MEMORY;                       // Write Memory Command
  buf[1] = writeParameterByte(page, segment);  // Memory Address (Page/Segment) to Write
  buf[2] = RELEASE_BYTE;                       // Start Transmission

  net.reset(OVERDRIVE);
  net.select(romID, OVERDRIVE);

  net.write_bytes(buf, 3, OVERDRIVE);

  for (uint8_t i = 0; i < len; i += 2) {
    buf[3] = data[i];       // B0
    buf[4] = data[i + 1];   // B1
    buf[5] = RELEASE_BYTE;  // End Transmission

    net.write_bytes(buf + 3, 3, OVERDRIVE);  // Send data
    net.read_bytes(buf + 6, 2, OVERDRIVE);   // Read 2-bytes for verification
    delay(16);                               // Wait for the programming completes (~16ms)

    uint8_t status = net.read(OVERDRIVE);  // Read CS byte returned by chip

    if (status != 0xAA)  // 0xAA for success write
    {
      result = false;
      break;
    }
  }

  net.reset(OVERDRIVE);  // End Transaction

  return result;
}

void setup(void) {
  Serial.begin(9600);

  uint8_t addr[8];
  bool detectFlag = false;

  net.reset(true);  // Reset device

  // Search for available device
  while (net.search(addr, true)) {
    if (OneWire::crc8(addr, 7) != addr[7]) {
      Serial.println("CRC is not valid!");
      break;
    }

    if (addr[0] == DS28E05_FAMILY_ID) {
      detectFlag = true;
      break;  // End search once DS28E05 was detected
    }
  }

  if (detectFlag) {
    uint8_t *txSerialID = (uint8_t *)"XXXXXX";  // Variable to store Serial ID to be written on DS28E05
    uint8_t lenSerialID = 6;                    // Variable to store the length of Serial ID

    uint8_t rxSerialID[MAX_BUF_SIZE];  // Variable to store Serial ID to be read from DS28E05

    DS28E05_read(addr, 0x00, lenSerialID, rxSerialID);

    Serial.print("Serial ID: ");
    PrintBytes(rxSerialID, 0, lenSerialID, false);  // Print Read Bytes from DS28E05
                                                    // Go to this link https://www.rapidtables.com/convert/number/hex-to-ascii.html
                                                    // to convert the hex values printed on the Serial Monitor into ASCII

    // free(rxSerialID);  // Free-up memory
  } else {
    Serial.println("No CONTACT BLOCK detected!");
  }
}

void loop(void) {
}
