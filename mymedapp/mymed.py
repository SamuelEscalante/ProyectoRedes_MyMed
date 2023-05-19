from pyspark.sql import SparkSession
from pyspark.sql.functions import col

# Crear una sesión de Spark
spark = SparkSession.builder.appName("Análisis de Medicamentos").getOrCreate()

# Cargar el archivo CSV de medicamentos
df = spark.read.csv("/home/vagrant/labSpark/datasetProyecto/mymedinventario.csv", header=True, inferSchema=True, sep=";")

# Análisis descriptivo
print("=== Análisis descriptivo ===")
df.describe("precio_unitario", "porcentaje_efectividad", "Ventas_Totales_Year").show()

# Guardar el dataframe como CSV
df.describe("precio_unitario", "porcentaje_efectividad", "Ventas_Totales_Year").write.csv("/home/vagrant/MyMedApp/db/data/descriptivo.csv", header=True)

# Análisis de tendencias
print("=== Análisis de tendencias ===")
df.groupBy("year_compra").avg("precio_unitario").orderBy("year_compra").show()

# Guardar el dataframe como CSV
df.groupBy("year_compra").avg("precio_unitario").orderBy("year_compra").write.csv("/home/vagrant/MyMedApp/db/data/tendencias.csv", header=True)

df.groupBy("year_compra").sum("Ventas_Totales_Year").orderBy("year_compra").show()

# Guardar el dataframe como CSV
df.groupBy("year_compra").sum("Ventas_Totales_Year").orderBy("year_compra").write.csv("/ruta/del/archivo/tendencias2.csv", header=True)

# Segmentación
print("=== Segmentación por laboratorio ===")
df.groupBy("laboratorio").sum("Ventas_Totales_Year").orderBy("sum(Ventas_Totales_Year)", ascending=False).show()

# Guardar el dataframe como CSV
df.groupBy("laboratorio").sum("Ventas_Totales_Year").orderBy("sum(Ventas_Totales_Year)", ascending=False).write.csv("/ruta/del/archivo/segmentacion_laboratorio.csv", header=True)

print("=== Segmentación por condición de venta ===")
df.groupBy("condicion_venta").avg("precio_unitario").orderBy("condicion_venta").show()

# Guardar el dataframe como CSV
df.groupBy("condicion_venta").avg("precio_unitario").orderBy("condicion_venta").write.csv("/ruta/del/archivo/segmentacion_condicion_venta.csv", header=True)

# Análisis de caducidad
print("=== Análisis de caducidad ===")
df.withColumn("tiempo_restante_caducidad", col("year_caducidad") - col("year_compra")).groupBy("tiempo_restante_caducidad").count().orderBy("tiempo_restante_caducidad").show()

# Guardar el dataframe como CSV
df.withColumn("tiempo_restante_caducidad", col("year_caducidad") - col("year_compra")).groupBy("tiempo_restante_caducidad").count().orderBy("tiempo_restante_caducidad").write.csv("/ruta/del/archivo/analisis_caducidad.csv", header=True)

# Análisis de precios
print("=== Análisis de precios ===")
df.orderBy("precio_unitario", ascending=False).show(5)
df.groupBy("laboratorio").avg("precio_unitario").orderBy("avg(precio_unitario)", ascending=False).show()

# Guardar el dataframe como CSV
df.orderBy("precio_unitario", ascending=False).write.csv("/ruta/del/archivo/analisis_precios.csv", header=True)
df.groupBy("laboratorio").avg("precio_unitario").orderBy("avg(precio_unitario)", ascending=False).write.csv("/ruta/del/archivo/analisis_precios2.csv", header=True)

# Cierra la sesión de Spark
spark.stop()
