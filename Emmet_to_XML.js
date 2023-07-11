function EmmetToXML(input, getElementValue, getAtr, getAtrValue) 
{
    let output = "";

    let tags = [[]];
    let currentTag = "";

    let currentGroup = 0;
    let groupCount = [];
    groupCount[0] = 0;
    let wasGrouped = false;

    let attributes = "";
    let textValue = "";

    let currentLevel = 1;

    

    for (let i = 0; i < input.length; i++) 
    {
        let char = input[i];
        if (char == ">") 
        {
            if(wasGrouped)
            {
                wasGrouped = false;
                continue;
            }
            groupCount[currentGroup]++;
            tags[currentGroup][currentLevel - 1] = currentTag;
            
            output += "\n" + "\t".repeat(currentLevel) + "<" + currentTag + attributes + ">" + textValue;

            currentTag = "";
            attributes = "";
            textValue = "";
            currentLevel++;
        }
        else if (char == "+") 
        {
            if(wasGrouped)
            {
                wasGrouped = false;
                continue;
            }
            
            tags[currentGroup][currentLevel - 1] = currentTag;
            output += "\n" + "\t".repeat(currentLevel) + "<" + tags[currentGroup][currentLevel - 1] + attributes + ">" + textValue + "</" + tags[currentGroup][currentLevel - 1] + ">";
            
            currentTag = "";
            attributes = "";
            textValue = "";
        }
        else if (char == "^") 
        {
            if (currentTag=="")
            {
                currentLevel--;
                output += "\n" + "\t".repeat(currentLevel) + "</" + tags[currentGroup][currentLevel - 1] + ">";
            }
            else
            {
                tags[currentGroup][currentLevel - 1] = currentTag;
                output += "\n" + "\t".repeat(currentLevel) + "<" + tags[currentGroup][currentLevel - 1] + attributes + ">" + textValue + "</" + tags[currentGroup][currentLevel - 1] + ">";

                currentLevel--;

                output += "\n" + "\t".repeat(currentLevel) + "</" + tags[currentGroup][currentLevel - 1] + ">";

                currentTag = "";
                attributes = "";
                textValue = "";
            }
        }
        else if (char == "{")
        {
            if(!getElementValue)
            {
                i++;
                char = input[i];
                while (char != "}")
                {
                    i++;
                    char = input[i];
                }
            }
            else
            {
                i++;
                char = input[i];
                while (char != "}")
                {
                    textValue += char;

                    i++;
                    char = input[i];
                }                
            }

        }
        else if (char == "(")
        {
            currentGroup++;
            groupCount[currentGroup] = 1;

            if(currentGroup >= tags.length)
            {
                tags.push([]);
            }
        }
        else if (char == ")")
        {
            output += "\n" + "\t".repeat(currentLevel) + "<" + currentTag + attributes + ">" + textValue + "</" + currentTag + ">";
            for( let j = 0; j < groupCount[currentGroup] - 1; j++)
            {
                currentLevel--;
                output += "\n" + "\t".repeat(currentLevel) + "</" + tags[currentGroup][currentLevel - 1] + ">";
            }
            currentGroup--;
            
            currentTag = "";
            attributes = "";
            textValue = "";

            wasGrouped = true;
        }
        else if (char == "[")
        {
            if(!getAtr)
            {
                i++;
                char = input[i];
                while (char != "]")
                {
                    i++;
                    char = input[i];
                }
            }
            else 
            {
                let hasValue = false;
                let inString = false;
    
                i++;
                char = input[i];
                while (char != "]")
                {
                    if (char == "\"" && !inString) inString = true;
                    else if (char=="\"" && inString) inString = false;
                    if (char == "=")
                    {
                        if(!getAtrValue)
                        {
                            let cnt = 0;
                            while(cnt != 2)
                            {
                                i++;
                                char = input[i];
                                if(char == "\"") cnt++;
                            }
                        }
                        else
                        {
                            hasValue = true;
                            attributes += char;                        
                        }

                    }
                    else if (hasValue && char == " " && !inString)
                    {
                        hasValue = false;
                        attributes += " ";
                    }
                    else if (!hasValue && char == " " && !inString && getAtrValue) attributes += '="" ';
                    else if (!hasValue && input[i + 1] == "]" && getAtrValue) 
                        attributes += char + '=""';
                    else attributes += char;
    
                    i++;
                    char = input[i];
                }
                attributes = " " + attributes;
            }

        }
        else 
        {
            currentTag += char;
        }
    }

    tags[currentGroup][currentLevel - 1] = currentTag;
    if (currentTag != "") output += "\n" + "\t".repeat(currentLevel) + "<" + currentTag + attributes + ">" + textValue;

    if(input[input.length - 1] == ")")
    {
        output += "\n" + "\t".repeat(currentLevel-1);
    }
    for (let i = 0; currentLevel > i; currentLevel--) {
        if(tags[currentGroup][currentLevel - 1] != "") output += "</" + tags[currentGroup][currentLevel - 1] + ">\n" + "\t".repeat(currentLevel - 1);
    }

    console.log(output);

    return output;
}
    