<p align="center">
    <img src="logo_cropped.png" width=120>
</p>

## Presentation
This project was created by Bocconi's **<font color="purple">Hephaestus Applied Artificial Intelligence Association</font>** during Spring 2024 period. In this repository you can find the final paper with a detailed explanation of motivations, execution and results of our research. If you wish to investigate the code we used to conduct our analysis you can find all the scripts in the present repository. For some help in navigating the repository, please have a look at [last section](#navigator).

## Description
The objective of this project is to provide a comprehensive statistical analysis of responses collecteds from the "Campionati della Cultura e del Talento", an annual competition designed for Italian high school students. This contest involves a series of 50 multiple-choice questions, covering a range of topics that vary each year. Following the administration of the quiz, teachers grade the paper answer sheets and forward the scores along with scanned copies of the completed quizzes to the hosting association. Traditionally, the association selects a random subset of these quizzes for detailed analysis to extract data and insights.

Conversely, this project aims to enhance the scope of analysis by including all submitted scores. To achieve this, a program equipped with advanced letter recognition capabilities was developed, facilitating the precise classification and organisation of data into a well-structured table. This method allows for a more thorough and accurate evaluation of the competition’s outcomes.

## Dataset
The original dataset is composed of photos or scanned documents of the tests. In order to use we needed to normalize images and extract letters from them in order to train a classifier. Details can be found in the <code>main.ipynb</code> file. 

## Classification
To reduce dimensionality of our datapoints we applied Principal Component Analysis (PCA), to convert a 11140 × 37440 dimensional array into a 11140 × 400 one, with the least possible data loss.
To classify our data we then tried Support Vector Machine and Stochastic Gradient Descent classifiers. Hyperparameters of both algorithms were tuned using cross-validated GridSearch. Finally, SVM model revealed to be the best-performing one. 

Theoretical details on these procedures can be found in the <code>report.pdf</code> file



## How to navigate this repository? <a name="navigator"></a>
Here's the structure and content of this repository:

<pre>
├───0_raw_dataset       - where to upload dataset
├───1_files             - where JPEG files are stored
├───2_cropped           - where answer tables only are stored
├───3_labelling_img     - where single-letter images are stored
├───cascade             - contains the Haar Classifier
│   └───classifier
├───poppler-24.02.0     - needed for PDF to JPEG conversion
├───<b>predict             - look at this folder README if you want to use the trained classifier
│   └───files</b>
├───site                - PHP sites created for manual labelling
├─IMG.csv               - output csv table after labelling
├─PCA_model.pkl         - PCA model parameters
├─SVC_model.pkl         - SVM model parameters
├─<b>main.ipynb            - The main file containing data preprocessing, analysis and classifier training, testing</b>
├─mask.png              - mask applied to answer tables
├─report.pdf            - the official report describing our work
</pre>

If you wish to have a look at our analysis (from data preparation to classifier) and reproduce it, you can go through the <code>main.ipynb</code> file. If instead you just want to apply the classifier to your own data, please download the entire repository and follow the instructions in the <code>/predict</code> folder.

**NOTE:** For privacy reasons, the original dataset has been removed from this repository.
