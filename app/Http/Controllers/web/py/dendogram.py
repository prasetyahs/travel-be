from flask import Flask, render_template, send_file, jsonify, make_response
from scipy.cluster.hierarchy import dendrogram, linkage
import numpy as np
from io import BytesIO
import matplotlib.pyplot as plt
import matplotlib
import json
from flask_cors import CORS

matplotlib.use('Agg')  # Set the backend to Agg

app = Flask(__name__)
CORS(app)

file_path = r"D:\sweet\travel-be\storage\data.json"
with open(file_path, "r") as file:
    data = json.load(file)

data = np.array(data["data"])
column_0 = data[:, 0]
column_1 = data[:, 1]
column_2 = data[:, 2]
travelName = data[:, 3]
data = np.column_stack((column_0, column_1, column_2))
data = np.array(data, dtype=float)

# Create a dendrogram and save it as an image
def create_dendrogram():
    plt.figure(figsize=(20, 10))
    linkage_matrix = linkage(data, method='ward')
    dendro = dendrogram(linkage_matrix, no_labels=False)
    image_stream = BytesIO()
    plt.savefig(image_stream, format='png')
    image_stream.seek(0)
    plt.close()
    return image_stream.getvalue()

# Create a dendrogram and return it as JSON
def create_dendrogram_json():
    linkage_matrix = linkage(data, method='ward')
    dendro = dendrogram(linkage_matrix, no_labels=True)
    image_stream = BytesIO()
    plt.savefig(image_stream, format='png')
    image_stream.seek(0)
    plt.close()
    return image_stream.getvalue()

@app.route('/')
def index():
    return render_template('index_dendrogram_api.html')

@app.route('/api/dendrogram')
def dendrogram_api():
    dendrogram_binary = create_dendrogram()
    response = make_response(dendrogram_binary)
    response.headers['Content-Type'] = 'image/png'
    response.headers['Content-Disposition'] = 'inline; filename=dendrogram.png'
    return response

if __name__ == '__main__':
    app.run(debug=True)
