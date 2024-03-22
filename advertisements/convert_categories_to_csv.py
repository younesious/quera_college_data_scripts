import pandas as pd

df = pd.read_excel("Category.xlsx")

df.drop(['IDGrandParent'], axis=1)

print(df)

df.to_csv("products.csv", index=None, header=True)
