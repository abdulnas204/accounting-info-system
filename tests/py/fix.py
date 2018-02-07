entries = []
i = 1
with open('street_names.txt', 'r') as file:
	for line in file:
		if(i % 3 == 0):
			pass
		else:
			entries.append(line)
		i += 1

print(entries)

import csv
with open('streets.txt', 'w') as file:
	for entry in entries:
		file.write(entry)
