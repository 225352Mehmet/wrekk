import openai

openai.api_key = "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"

while True:
    user_input = input("Sen: ")
    if user_input.lower() in ["çık", "quit", "exit"]:
        break

    response = openai.ChatCompletion.create(
        model="gpt-4o-mini",
        messages=[
            {"role": "system", "content": "Sen yardımcı bir asistansın."},
            {"role": "user", "content": user_input}
        ]
    )

    print("Bot:", response.choices[0].message.content)
