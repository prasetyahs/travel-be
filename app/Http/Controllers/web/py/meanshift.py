import json
from flask import Flask, jsonify
from flask_cors import CORS
from sklearn.cluster import MeanShift, estimate_bandwidth
import numpy as np

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

# Perform MeanShift clustering
bandwidth = estimate_bandwidth(data, quantile=0.2, n_samples=500)
ms = MeanShift(bandwidth=bandwidth, bin_seeding=True)
ms.fit(data)

# Add cluster labels to the original data
data_with_labels = np.column_stack((data, ms.labels_))


@app.route("/clusters", methods=["GET"])
def get_clusters():
    # Convert data to a list of dictionaries for JSON response
    clusters = []
    for i in range(max(ms.labels_) + 1):
        cluster_data = data_with_labels[data_with_labels[:, -1] == i, :-1]
        cluster_dict = {
            "cluster_id": i,
            "data": cluster_data.tolist(),
        }
        clusters.append(cluster_dict)

    return jsonify({"clusters": clusters})


if __name__ == "__main__":
    app.run(port=5000)
