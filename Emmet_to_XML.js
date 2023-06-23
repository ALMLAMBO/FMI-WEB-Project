function EmmetToXML(input) 
{
    let output = "";

    let tags = [];
    let currentTag = "";

    let currentLevel = 1;

    for (let i = 0; i < input.length; i++) 
    {
        let char = input[i];
        if (char === ">") 
        {
            tags[currentLevel - 1] = currentTag;

            output += "\n" + "\t".repeat(currentLevel) + "<" + tags[currentLevel - 1] + ">";

            currentLevel++;
            currentTag = "";
        }
        else if (char == "+") 
        {
            tags[currentLevel - 1] = currentTag;
            output += "\n" + "\t".repeat(currentLevel) + "<" + tags[currentLevel - 1] + "></" + tags[currentLevel - 1] + ">";
            currentTag = "";
        }
        else if (char == "^") 
        {
            if (currentTag != "") 
            {
                tags[currentLevel - 1] = currentTag;
                output += "\n" + "\t".repeat(currentLevel) + "<" + tags[currentLevel - 1] + "></" + tags[currentLevel - 1] + ">";

                currentLevel--;
                output += "\n" + "\t".repeat(currentLevel) + "</" + tags[currentLevel - 1] + ">";
                currentTag = "";
            }
            else 
            {
                currentLevel--;
                output += "\n" + "\t".repeat(currentLevel) + "</" + tags[currentLevel - 1] + ">";
            }
        }
        else if (char == "{")
        {

        }
        else if (char == "}")
        {

        }
        else if (char == "(")
        {

        }
        else if (char == ")")
        {
            
        }
        else 
        {
            currentTag += char;
        }
    }

    tags[currentLevel - 1] = currentTag;
    output += "\n" + "\t".repeat(currentLevel) + "<" + currentTag + ">";

    for (let i = 0; currentLevel > i; currentLevel--) {
        output += "</" + tags[currentLevel - 1] + ">\n" + "\t".repeat(currentLevel - 1);
    }

    return output;
}